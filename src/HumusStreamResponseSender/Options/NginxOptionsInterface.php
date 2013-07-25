<?php
/**
 * This file is part of Humus module response sender
 *
 * @author Oleksandr Khutoretskyy <olekhy@gmail.com>
 * Date: 7/25/13
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
 * Interface NginxOptionsInterface
 * @package HumusStreamResponseSender\Options
 */
namespace HumusStreamResponseSender\Options;

interface NginxOptionsInterface
{
    /**
     * set location name which was configured at nginx as internal
     *
     * @param string $internalLocation
     *
     * @return $this
     */
    public function setNginxXSendFileInternalLocation($internalLocation);

    /**
     * @return string
     */
    public function getNginxXSendFileInternalLocation();

    /**
     * opted nginx buffering for x-send-file response
     *
     * @param   string  $flag no or yes
     *
     * @return string
     */
    public function setNginxXSendBuffering($flag);

    /**
     * get buffering flag
     *
     * @return string
     */
    public function getNginxXSendBuffering();

    /**
     * set charset
     *
     * @param   string  $charset
     *
     * @return string
     */
    public function setNginxXSendCharset($charset);

    /**
     * get charset
     *
     * @return string
     */
    public function getNginxXSendCharset();

    /**
     * set internal cache expires interval in seconds
     *
     * @param   mixed    $expires int seconds or false for cache is off
     *
     * @return $this
     */
    public function setNginxXSendInternalCacheExpires($expires);

    /**
     * get internal cache expires interval in seconds
     *
     * @return mixed    int seconds or false for cache is off
     */
    public function getNginxXSendInternalCacheExpires();

    /**
     * set number of bytes for rate limit
     *
     * @param mixed $rateLimit  int bytes rate limit of false for rate limit is off
     *
     * @return mixed
     */
    public function setNginxXSendRateLimit($rateLimit);

    /**
     * get rate limit
     *
     * @return mixed  int bytes or false for rate limit is off
     */
    public function getNginxXSendRateLimit();
}
