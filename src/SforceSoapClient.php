<?php

/*
 * (c) linuxdoanpham@gmail.com
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace phpsfclient\SalesforceSoapClient;
use phpsfclient\SalesforceSoapClient\SforceBaseClient;

class SforceSoapClient extends \SoapClient {
    function __doRequest($request, $location, $action, $version, $one_way=0) {
      $response = parent::__doRequest($request, $location, $action, $version, $one_way);
 
      // Quick check to only parse the XML here if we think we need to
      if (strpos($response, '<sf:OldValue') === false && strpos($response, '<sf:NewValue') === false) {
        return $response;
      }
 
      $dom = new DOMDocument();
      $dom->loadXML($response);
 
      $nodeList = $dom->getElementsByTagName('NewValue');
      foreach ($nodeList as $node) {
        $node->removeAttributeNS('http://www.w3.org/2001/XMLSchema-instance', 'type');
      }
      $nodeList = $dom->getElementsByTagName('OldValue');
      foreach ($nodeList as $node) {
        $node->removeAttributeNS('http://www.w3.org/2001/XMLSchema-instance', 'type');
      }
 
      return $dom->saveXML();      
    }
  }