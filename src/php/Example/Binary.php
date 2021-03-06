<?php

/**
 * Library Example is 100% generated. If you edit this file, you will
 * lose your changes at the next build cycle.
 * DO NOT MAKE ANY CHANGES YOU WISH TO KEEP.
 *
 * The correct places for commits are:
 *  - The XML model used for this code generation: zproto_example.xml
 *  - The code generation script that built this file: zproto_codec_php
 *
 *  Copyright (C) 2014 the Authors                                         
 *                                                                         
 *  Permission is hereby granted, free of charge, to any person obtaining  
 *  a copy of this software and associated documentation files (the        
 *  "Software"), to deal in the Software without restriction, including    
 *  without limitation the rights to use, copy, modify, merge, publish,    
 *  distribute, sublicense, and/or sell copies of the Software, and to     
 *  permit persons to whom the Software is furnished to do so, subject to  
 *  the following conditions:                                              
 *                                                                         
 *  The above copyright notice and this permission notice shall be included
 *  in all copies or substantial portions of the Software.                 
 *                                                                         
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 *  OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF             
 *  MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. 
 *  IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY   
 *  CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,   
 *  TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE      
 *  SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.                 
 */

namespace Zproto\Example;

use Zproto\Example;

/**
 * Deliver a multi-part message.
 */
class Binary extends Example
{
    /**
     * Message ID
     */
    const ID = 3;

    /**
     * @var number $sequence
     */
    public $sequence;

    /**
     * @var string $flags A set of flags
     */
    public $flags;

    /**
     * @var string $publicKey Our public key
     */
    public $publicKey;

    /**
     * @var string $identifier Unique identity
     */
    public $identifier;

    /**
     * @var string $address Return address as frame
     */
    public $address;

    /**
     * @var string $content Message to be delivered
     */
    public $content;

    /**
     * Unserializes a BINARY message
     *
     * @access public
     * @return void
     */
    public function unserialize()
    {
        parent::unserialize();

        $this->sequence   = $this->getNumber2();
        $this->flags      = $this->getOctets(4);
        $this->publicKey  = $this->getBytes();
        $this->identifier = $this->getUuid();

        // Cleanup
        $this->needle = 0;
        // 0xAAA0 is the signature of the messages
        $this->buffer = pack('C*', 0xAA, 0xA0 | 0, static::ID);
    }

    /**
     * Serializes a BINARY message
     *
     * @access public
     * @return serialized binary data
     */
    public function serialize()
    {
        $this->putNumber2($this->sequence);
        $this->putOctets($this->flags, 4);
        $this->putBytes($this->publicKey);
        $this->putUuid($this->identifier);

        return $this->buffer;
    }
}
