<?php
require_once 'Erfurt/TestCase.php';

require_once 'Erfurt/Rdf/Resource.php';

/**
 * Test class for Erfurt_Rdf_Resource.
 * Generated by PHPUnit on 2009-06-08 at 10:38:28.
 */
class Erfurt_Rdf_ResourceTest extends Erfurt_TestCase
{
    /**
     * @var    Erfurt_Rdf_Resource
     * @access protected
     */
    protected $_object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @access protected
     */
    protected function setUp()
    {
        $this->_object = new Erfurt_Rdf_Resource('http://example.org/resource1');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @access protected
     */
    protected function tearDown()
    {
    }

    /**
     * @todo Implement test__toString().
     */
    public function test__toString()
    {
        $should = 'http://example.org/resource1';
        $is = (string)$this->_object;
        $this->assertEquals($should, $is);
    }

    /**
     * @todo Implement testGetIri().
     */
    public function testGetIri()
    {
        $should = 'http://example.org/resource1';
        $is = $this->_object->getIri();
        $this->assertEquals($should, $is);
    }

    /**
     * @todo Implement testGetQualifiedName().
     */
    public function testGetQualifiedName()
    {
        // First we test with the standard object (no qname).
        $this->assertEquals(null, $this->_object->getQualifiedName());
        
        // Now we test with a real qname.
        $this->markTestNeedsDatabase();
        $this->authenticateDbUser();
        $model = Erfurt_App::getInstance()->getSysOntModel();
        
        $r = new Erfurt_Rdf_Resource(EF_RDF_TYPE, $model);
        $this->assertEquals('rdf:type', $r->getQualifiedName());
    }

    /**
     * @todo Implement testGetNamespace().
     */
    public function testGetNamespace()
    {
        $should = 'http://example.org/';
        $is = $this->_object->getNamespace();
        $this->assertEquals($should, $is);
    }

    /**
     * @todo Implement testGetLocalName().
     */
    public function testGetLocalName()
    {
        $should = 'resource1';
        $is = $this->_object->getLocalName();
        $this->assertEquals($should, $is);
    }

    /**
     * @todo Implement testInitWithIri().
     */
    public function testInitWithIri()
    {
        $r = Erfurt_Rdf_Resource::initWithIri('http://example.org/resourceXX');
        $this->assertTrue($r instanceof Erfurt_Rdf_Resource);
        $this->assertEquals('http://example.org/resourceXX', $r->getUri());
        $this->assertEquals('http://example.org/', $r->getNamespace());
        $this->assertEquals('resourceXX', $r->getLocalName());
    }

    /**
     * @todo Implement testInitWithUri().
     */
    public function testInitWithUri()
    {
        $r = Erfurt_Rdf_Resource::initWithUri('http://example.org/resource123');
        $this->assertTrue($r instanceof Erfurt_Rdf_Resource);
        $this->assertEquals('http://example.org/resource123', $r->getUri());
        $this->assertEquals('http://example.org/', $r->getNamespace());
        $this->assertEquals('resource123', $r->getLocalName());
    }

    /**
     * @todo Implement testInitWithNamespaceAndLocalname().
     */
    public function testInitWithNamespaceAndLocalname()
    {
        $ns = 'http://example.org/';
        $l  = 'resourceLocal123abc';
        
        $r = Erfurt_Rdf_Resource::initWithNamespaceAndLocalName($ns, $l);
        $this->assertTrue($r instanceof Erfurt_Rdf_Resource);
        $this->assertEquals('http://example.org/resourceLocal123abc', $r->getUri());
        $this->assertEquals('http://example.org/', $r->getNamespace());
        $this->assertEquals('resourceLocal123abc', $r->getLocalName());
    }

    /**
     * @todo Implement testInitWithBlankNode().
     */
    public function testInitWithBlankNode()
    {
        $bn = Erfurt_Rdf_Resource::initWithBlankNode('bnode123');
        $this->assertTrue($bn instanceof Erfurt_Rdf_Resource);
        $this->assertTrue($bn->isBlankNode());
        $this->assertEquals('bnode123', $bn->getId());
    }

    /**
     * @todo Implement testIsBlankNode().
     */
    public function testIsBlankNode()
    {
        $bn = Erfurt_Rdf_Resource::initWithBlankNode('bnode123456789abc');
        $this->assertTrue($bn->isBlankNode());
    }

    /**
     * @todo Implement testGetId().
     */
    public function testGetId()
    {
        $bn = Erfurt_Rdf_Resource::initWithBlankNode('bnode123abcdefghjiklmnopqrstuvwxyz');
        $this->assertEquals('bnode123abcdefghjiklmnopqrstuvwxyz', $bn->getId());
    }

    /**
     * @todo Implement testGetUri().
     */
    public function testGetUri()
    {
        $should = 'http://example.org/resource1';
        $is = $this->_object->getUri();
        $this->assertEquals($should, $is);
    }
    
    public function testGetDescription()
    {
        $this->markTestNeedsDatabase();
        $this->authenticateDbUser();
        $model = Erfurt_App::getInstance()->getSysOntModel();
        $resource = new Erfurt_Rdf_Resource('http://ns.ontowiki.net/SysOnt/Anonymous', $model);
        
        $expected = array(
            'http://ns.ontowiki.net/SysOnt/Anonymous' => array(
                'http://www.w3.org/1999/02/22-rdf-syntax-ns#type' => array(
                    array(
                        'type' => 'uri', 
                        'value' => 'http://rdfs.org/sioc/ns#User'
                    )
                ), 
                'http://www.w3.org/2000/01/rdf-schema#label' => array(
                    array(
                        'type' => 'literal', 
                        'value' => 'Anonymous'
                    )
                ), 
                'http://www.w3.org/2000/01/rdf-schema#comment' => array(
                    array(
                        'type' => 'literal', 
                        'value' => 'This special account identifies the anonymous user.'
                    )
                ), 
                'http://ns.ontowiki.net/SysOnt/grantAccess' => array(
                    array(
                        'type' => 'uri', 
                        'value' => 'http://ns.ontowiki.net/SysOnt/RegisterNewUser'
                    )
                ), 
                'http://ns.ontowiki.net/SysOnt/grantModelEdit' => array(
                    array(
                        'type' => 'uri', 
                        'value' => 'http://ns.ontowiki.net/SysOnt/AnyModel'
                    )
                ),
                'http://ns.ontowiki.net/SysOnt/grantModelView' => array(
                    array(
                        'type' => 'uri', 
                        'value' => 'http://ns.ontowiki.net/SysOnt/AnyModel'
                    ), 
                    array(
                        'type' => 'uri', 
                        'value' => 'http://ns.ontowiki.net/SysBase/'
                    )
                ), 
                'http://ns.ontowiki.net/SysOnt/denyModelView' => array(
                    array(
                        'type' => 'uri', 
                        'value' => 'http://ns.ontowiki.net/SysOnt/'
                    )
                ), 
                'http://ns.ontowiki.net/SysOnt/denyAccess' => array(
                    array(
                        'type' => 'uri', 
                        'value' => 'http://ns.ontowiki.net/SysOnt/Login'
                    ), 
                    array(
                        'type' => 'uri', 
                        'value' => 'http://ns.ontowiki.net/SysOnt/Rollback'
                    )
                )
            )
        );
        
        $this->assertEquals($expected, $resource->getDescription());
    }
    
    public function testGetLocatorNoLocator()
    {
        $uri = new Erfurt_Rdf_Resource('http://example.org/testResource1');
        $this->assertEquals('http://example.org/testResource1', $uri->getLocator());
    }
    
    public function testGetLocator()
    {
        $uri = new Erfurt_Rdf_Resource('http://example.org/testResource1');
        $uri->setLocator('http://example.org/testLocator');
        $this->assertEquals('http://example.org/testLocator', $uri->getLocator());
    }
}
