<?php

class CacheMgr{

        // Application settings

        // This must be unique per instance of application.
        // For example a live/beta release on the same APC/PHP server must have different strings here
        // If you forget they will share caching information
        public static $CACHE_PRE_STRING = 'php-cache-mgr-1';

        // If you set this to true the cache string will be hashed in MD5
        // If false (default), it will be self::$CACHE_PRE_STRING.'name'
        public static $CACHE_STRING_HASH = false;

        //
        // Public Functions, can all from other Apps
        //

        // Get a value from cache
        public static function get($name){
                $name = self::cache_name($name);
                return apc_fetch(self::cache_name($name));
        }

        // Add a value to the cache
        public static function set($name, $value){
                $name = self::cache_name($name);
                return apc_store(self::cache_name($name), $value);
        }

        // Remove value from cache
        public static function purge($name){
                $name = self::cache_name($name);
                return apc_delete(self::cache_name($name));
        }

        //
        // Protected functions go below
        //

        // Create the unique cache name.
        protected static function cache_name($name){
                if(self::$CACHE_STRING_HASH) return md5(self::$CACHE_PRE_STRING.$name);
                else return self::$CACHE_PRE_STRING.$name;
        }
}
?>