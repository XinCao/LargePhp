<?php
// **********************************************************************
//
// Copyright (c) 2003-2011 ZeroC, Inc. All rights reserved.
//
// This copy of Ice is licensed to you under the terms described in the
// ICE_LICENSE file included in this distribution.
//
// **********************************************************************
//
// Ice version 3.4.2
//
// <auto-generated>
//
// Generated from file `DeviceRegistry.ice'
//
// Warning: do not edit this file.
//
// </auto-generated>
//

namespace DreamHeaven\Services;

global $IcePHP__t_bool;
global $IcePHP__t_byte;
global $IcePHP__t_short;
global $IcePHP__t_int;
global $IcePHP__t_long;
global $IcePHP__t_float;
global $IcePHP__t_double;
global $IcePHP__t_string;
global $Ice__t_Object;

global $DreamHeaven_Services__t_StringList;
global $DreamHeaven_Services__t_StringMap;

if(!interface_exists('\\DreamHeaven\\Services\\DeviceRegistry'))
{
    interface DeviceRegistry
    {
        public function register($userId, $provider, $platfrom, $deviceToken);
        public function unregister($regId);
        public function unregisterByToken($deviceToken);
        public function changeProvider($regId, $newProvider);
        public function revertProvider($regId);
        public function suspend($regId);
        public function resume($regId);
        public function purgeExpired();
    }

    class DeviceRegistryPrxHelper
    {
        public static function checkedCast($proxy, $facetOrCtx=null, $ctx=null)
        {
            return $proxy->ice_checkedCast('::DreamHeaven::Services::DeviceRegistry', $facetOrCtx, $ctx);
        }

        public static function uncheckedCast($proxy, $facet=null)
        {
            return $proxy->ice_uncheckedCast('::DreamHeaven::Services::DeviceRegistry', $facet);
        }
    }

    $DreamHeaven_Services__t_DeviceRegistry = IcePHP_defineClass('::DreamHeaven::Services::DeviceRegistry', '\\DreamHeaven\\Services\\DeviceRegistry', true, $Ice__t_Object, null, null);

    $DreamHeaven_Services__t_DeviceRegistryPrx = IcePHP_defineProxy($DreamHeaven_Services__t_DeviceRegistry);

    IcePHP_defineOperation($DreamHeaven_Services__t_DeviceRegistry, 'register', 0, 0, array($IcePHP__t_string, $IcePHP__t_string, $IcePHP__t_string, $IcePHP__t_string), null, $IcePHP__t_string, null);
    IcePHP_defineOperation($DreamHeaven_Services__t_DeviceRegistry, 'unregister', 0, 0, array($IcePHP__t_string), null, null, null);
    IcePHP_defineOperation($DreamHeaven_Services__t_DeviceRegistry, 'unregisterByToken', 0, 0, array($IcePHP__t_string), null, null, null);
    IcePHP_defineOperation($DreamHeaven_Services__t_DeviceRegistry, 'changeProvider', 0, 0, array($IcePHP__t_string, $IcePHP__t_string), null, null, null);
    IcePHP_defineOperation($DreamHeaven_Services__t_DeviceRegistry, 'revertProvider', 0, 0, array($IcePHP__t_string), null, null, null);
    IcePHP_defineOperation($DreamHeaven_Services__t_DeviceRegistry, 'suspend', 0, 0, array($IcePHP__t_string), null, null, null);
    IcePHP_defineOperation($DreamHeaven_Services__t_DeviceRegistry, 'resume', 0, 0, array($IcePHP__t_string), null, null, null);
    IcePHP_defineOperation($DreamHeaven_Services__t_DeviceRegistry, 'purgeExpired', 0, 0, null, null, null, null);
}

