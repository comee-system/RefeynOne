<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\MailSendComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\MailSendComponent Test Case
 */
class MailSendComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\MailSendComponent
     */
    public $MailSend;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->MailSend = new MailSendComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MailSend);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
