<?php
/*
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

namespace HumusStreamResponseSender\Options;

use HumusStreamResponseSender\Exception\InvalidArgumentException;
use Zend\Stdlib\AbstractOptions;

/**
 * @category   Humus
 * @package    HumusStreamResponseSender
 * @license    MIT
 */

class Options extends AbstractOptions implements
    OptionsInterface,
    NginxOptionsInterface,
    Apache2OptionsInterface
{
    // <editor-fold desc="Stream Response Sender options">

    /**
     * @var bool
     */
    protected $enableRangeSupport = false;

    /**
     * @var bool
     */
    protected $enableSpeedLimit = false;

    /**
     * @var int
     */
    protected $chunkSize = 262144; //in bytes (this will also be your download speed limit in bytes per second)

    // </editor-fold>

    // <editor-fold desc="Nginx X-SendFile options">
    /**
     * @var string|bool false buffering no or yes
     */
    protected $nginxXsendBuffering = false;

    /**
     * @var string|bool false set charset or won't use
     */
    protected $nginxXsendCharset = false;

    /**
     * @var string
     */
    protected $nginxXsendFileInternalLocation;

    /**
     * @var int|bool false
     */
    protected $nginxXsendInternalCacheExpires = false;

    /**
     * @var int|bool false
     */
    protected $nginxXsendRateLimit = false;

    // </editor-fold>

    // <editor-fold desc="Stream Response Sender standard options getter and setter">

    /**
     * Set chunk size in  bytes
     *
     * If enable speed limit is set to true, this will also be the speed limit in bytes per second
     *
     * @param int $chunkSize
     */
    public function setChunkSize($chunkSize)
    {
        $this->chunkSize = (int) $chunkSize;
    }

    /**
     * Get chunk size in bytes
     *
     * If enable speed limit is set to true, this will also be the speed limit in bytes per second
     *
     * @return int
     */
    public function getChunkSize()
    {
        return $this->chunkSize;
    }

    /**
     * Set enable range support
     *
     * @param bool $enableRangeSupport
     */
    public function setEnableRangeSupport($enableRangeSupport)
    {
        $this->enableRangeSupport = (bool) $enableRangeSupport;
    }

    /**
     * Get enable range support
     *
     * @return bool
     */
    public function getEnableRangeSupport()
    {
        return $this->enableRangeSupport;
    }

    /**
     * Set enable speed limit
     *
     * @param bool $enableSpeedLimit
     */
    public function setEnableSpeedLimit($enableSpeedLimit)
    {
        $this->enableSpeedLimit = (bool) $enableSpeedLimit;
    }

    /**
     * Get enable speed limit
     *
     * @return bool
     */
    public function getEnableSpeedLimit()
    {
        return $this->enableSpeedLimit;
    }

    // </editor-fold>

    // <editor-fold desc="Nginx X-SendFile options setter and getter">
    /**
     * @inherited
     */
    public function setNginxXSendFileInternalLocation($internalLocation)
    {
        if (!is_string($internalLocation) || strlen($internalLocation) == 0) {
            throw new InvalidArgumentException(
                sprintf(
                    'Invalid location string: "%s"',
                    $internalLocation
                )
            );
        }

        $this->nginxXsendFileInternalLocation = '/' . ltrim($internalLocation, '/');
        return $this;
    }

    /**
     * @return string
     */
    public function getNginxXSendFileInternalLocation()
    {
        return $this->nginxXsendFileInternalLocation;
    }

    /**
     * @inherited
     */
    public function setNginxXSendBuffering($flag)
    {
        $this->nginxXsendBuffering = $flag;
        return $this;
    }

    /**
     * @inherited
     */
    public function getNginxXSendBuffering()
    {
        return $this->nginxXsendBuffering;
    }

    /**
     * @inherited
     */
    public function setNginxXSendCharset($charset)
    {
        $this->nginxXsendCharset = $charset;
        return $this;
    }

    /**
     * @inherited
     */
    public function getNginxXSendCharset()
    {
        return $this->nginxXsendCharset;
    }

    /**
     * @inherited
     */
    public function setNginxXSendInternalCacheExpires($expires)
    {
        $this->nginxXsendInternalCacheExpires = $expires;
        return $this;
    }

    /**
     * @inherited
     */
    public function getNginxXSendInternalCacheExpires()
    {
        return $this->nginxXsendInternalCacheExpires;
    }


    /**
     * @inherited
     */
    public function setNginxXSendRateLimit($rateLimit)
    {
        $this->nginxXsendRateLimit = $rateLimit;
        return $this;
    }

    /**
     * @inherited
     */
    public function getNginxXSendRateLimit()
    {
        return $this->nginxXsendRateLimit;
    }
    // </editor-fold>
}
