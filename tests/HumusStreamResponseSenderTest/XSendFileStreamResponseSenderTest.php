<?php
/**
 * @author Oleksandr Khutoretskyy <olekhy@gmail.com>
 * Date: 7/22/13
 * Time: 8:47 PM
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

namespace HumusStreamResponseSenderTest;

use HumusStreamResponseSender\XSendFileStreamResponseSender;
use PHPUnit_Framework_TestCase as TestCase;

class XSendFileStreamResponseSenderTest extends TestCase
{
    public function testGetHeaders()
    {
        $allOptsAct = array(
            'nginx_x_send_buffering' => 'yes',
            'nginx_x_send_file_internal_location' => '/protected',
            'nginx_x_send_charset' => 'utf-8',
            'nginx_x_send_internal_cache_expires' => '123',
            'nginx_x_send_rate_limit' => '321',
        );
        $defaultOptsAct = array(
            'nginx_x_send_file_internal_location' => '/protected',
        );

        $utt = new XSendFileStreamResponseSender;
        $utt->setOptions($defaultOptsAct);
        $headers = $utt->getHeaders('test.file');

        $expected['X-Accel-Redirect'] = '/protected/test.file';
        $this->assertEquals($expected, $headers);

    }
}
