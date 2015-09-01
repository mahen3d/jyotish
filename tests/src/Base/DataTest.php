<?php
/**
 * @link      http://github.com/kunjara/jyotish for the canonical source repository
 * @license   GNU General Public License version 2 or later
 */

namespace JyotishTest\Base;

use Jyotish\Base\Data;
use Mockery;
use DateTime;

/**
 * @group Base
 */
class DataTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        
        $DateTime = new DateTime;
        
        $Locality = Mockery::mock('Jyotish\Base\Locality');
        $Locality->shouldReceive('getLongitude', 'getLatitude', 'getAltitude');
        
        $Ganita = Mockery::mock('Jyotish\Ganita\Method\AbstractGanita');
        
        $this->Data = new Data($DateTime, $Locality, $Ganita);
    }
    
    public function tearDown()
    {
        $this->Data = null;
        Mockery::close();
    }
    
    /**
     * @covers Jyotish\Base\Data::listBlock
     */
    public function testListBlock()
    {
        $blocks = ['bhava', 'graha', 'kala', 'lagna', 'panchanga', 'upagraha', 'varga', 'yoga'];
        $blocksActual = array_values(Data::listBlock('worising'));
        $this->assertEquals($blocks, $blocksActual);
        
        $blocks = ['bhava', 'graha', 'kala', 'lagna', 'panchanga', 'rising', 'upagraha', 'varga', 'yoga'];
        $blocksActual = array_values(Data::listBlock('calc'));
        $this->assertEquals($blocks, $blocksActual);
    }
    
    /**
     * @covers Jyotish\Base\Data::getDateTime
     */
    public function testGetDateTime()
	{
		$this->assertInstanceOf('DateTime', $this->Data->getDateTime());
	}
    
    /**
     * @covers Jyotish\Base\Data::getLocality
     */
    public function testGetLocality()
	{
		$this->assertInstanceOf('Jyotish\Base\Locality', $this->Data->getLocality());
	}
    
    /**
     * @covers Jyotish\Base\Data::getData
     */
    public function testGetData()
	{
		$this->assertArrayHasKey('user', $this->Data->getData());
	}
}
