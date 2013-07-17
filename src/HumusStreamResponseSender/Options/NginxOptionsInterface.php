<?php
/**
 * Created by JetBrains PhpStorm.
 * @author Oleksandr Khutoretskyy <olekhy@gmail.com>
 * Date: 7/17/13
 * Time: 5:10 PM
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
    public function setNginxXsendFileInternalLocation($internalLocation);

    /**
     * @return string
     */
    public function getNginxXsendFileInternalLocation();

    /**
     * opted nginx buffering for x-send-file response
     *
     * @param   string  $flag no or yes
     *
     * @return string
     */
    public function setNginxXsendBuffering($flag);

    /**
     * get buffering flag
     *
     * @return string
     */
    public function getNginxXsendBuffering();

    /**
     * set charset
     *
     * @param   string  $charset
     *
     * @return string
     */
    public function setNginxXsendCharset($charset);

    /**
     * get charset
     *
     * @return string
     */
    public function getNginxXsendCharset();

    /**
     * set internal cache expires interval in seconds
     *
     * @param   mixed    $expires int seconds or false for cache is off
     *
     * @return $this
     */
    public function setNginxXsendInternalCacheExpires($expires);

    /**
     * get internal cache expires interval in seconds
     *
     * @return mixed    int seconds or false for cache is off
     */
    public function getNginxXsendInternalCacheExpires();

    /**
     * set number of bytes for rate limit
     *
     * @param mixed $rateLimit  int bytes rate limit of false for rate limit is off
     *
     * @return mixed
     */
    public function setNginxXsendRateLimit($rateLimit);

    /**
     * get rate limit
     *
     * @return mixed  int bytes or false for rate limit is off
     */
    public function getNginxXsendRateLimit();
}
