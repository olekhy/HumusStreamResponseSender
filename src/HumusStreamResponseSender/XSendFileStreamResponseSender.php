<?php
/**
 * This file is part of Humus module response sender
 *
 * @author Oleksandr Khutoretskyy <olekhy@gmail.com>
 * Date: 7/17/13
 * Time: 1:34 PM
 * @license MIT
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */
/**
 * Class XSendFileStreamResponseSender
 * @package HumusStreamResponseSender
 */
namespace HumusStreamResponseSender;

use HumusStreamResponseSender\Options\NginxOptionsInterface;
use HumusStreamResponseSender\Options\Options;
use Traversable;
use Zend\Db\TableGateway\Exception\RuntimeException;
use Zend\Http\Request;
use Zend\Http\Response\Stream;
use Zend\Mvc\ResponseSender\SimpleStreamResponseSender;
use Zend\Mvc\ResponseSender\SendResponseEvent;

/**
 * @category   Humus
 * @package    HumusStreamResponseSender
 * @license    MIT
 */
class XSendFileStreamResponseSender extends SimpleStreamResponseSender
{
    /**
     * @var Options
     */
    protected $options;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param array|Traversable|null|Options $options
     */
    public function __construct($options = null)
    {
        if (null !== $options) {
            $this->setOptions($options);
        }
    }

    /**
     * Set options
     *
     * @param array|Traversable|Options $options
     * @return $this
     */
    public function setOptions($options)
    {
        if (!$options instanceof Options) {
            $options = new Options($options);
        }
        $this->options = $options;
        return $this;
    }

    /**
     * Get options
     *
     * @return Options
     */
    public function getOptions()
    {
        if (!$this->options instanceof Options) {
            $this->options = new Options();
        }
        return $this->options;
    }

    /**
     * Set request
     *
     * @param Request $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get request
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Send HTTP headers
     *
     * @param  SendResponseEvent $event
     *
     * @throws RuntimeException
     * @return StreamResponseSender
     */
    public function sendHeaders(SendResponseEvent $event)
    {
        /* @var $response Stream */
        $response = $event->getResponse();
        $filename = $response->getStreamName();

        $headers = $this->getHeaders($filename);

        if (empty($headers)) {
            // we do nothing here
            return;
        }

        $responseHeaders = $response->getHeaders();
        $responseHeaders->addHeaders($headers);

        parent::sendHeaders($event);
    }

    /**
     * build specific headers
     *
     * @param   string $filename
     *
     * @throws RuntimeException
     * @return array
     */
    public function getHeaders($filename)
    {
        if ($this->options instanceof NginxOptionsInterface) {
            return $this->getNginxHeaders($this->options, $filename);
        } else {
            throw new RuntimeException(
                sprintf(
                    'X-Sendfile not yet implemented for given type: %s',
                    get_class($this->options)
                )
            );
        }
    }
    /**
     * Send the stream
     *
     * the script will not handle sending with X send file
     * that is the task of the server
     *
     * @param SendResponseEvent $event
     * @return self
     */
    public function sendStream(SendResponseEvent $event)
    {
        if (!$event->contentSent()) {
            $event->setContentSent();
        }
        return $this;
    }

    /**
     * build headers for nginx
     *
     * @param   NginxOptionsInterface   $options
     * @param   string                  $filename
     * @return  array
     */
    protected function getNginxHeaders(NginxOptionsInterface $options, $filename)
    {
        $location = $options->getNginxXSendFileInternalLocation();
        $headers = array();
        $expires = $options->getNginxXSendInternalCacheExpires();
        if (false !== $expires) {
            $headers['X-Accel-Expires'] = $expires;
        }

        $rateLimit = $options->getNginxXSendRateLimit();
        if (false !== $rateLimit) {
            $headers['X-Accel-Limit-Rate'] = $rateLimit;
        }

        $charset = $options->getNginxXSendCharset();
        if (false !== $charset) {
            $headers['X-Accel-Charset'] = $charset;
        }

        $buffering = $options->getNginxXSendBuffering();
        if (false !== $buffering) {
            $headers['X-Accel-Buffering'] = $buffering;
        }

        $headers['X-Accel-Redirect'] = $location . '/' . $filename;

        return $headers;
    }
}
