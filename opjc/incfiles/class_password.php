<?php 
/** 
 * Simple and secury password hashing class 
 * @author Julius Beckmann http://juliusbeckmann.de/ 
 * @license GPL 
 * @package password 
 */ 
class password { 
     
    /** 
     * Password Salt 
     * ------------------------------- 
     * ---- Change every project! ---- 
     * ------------------------------- 
     * Should NOT be changed wenn hashes have been created! 
     * --> Better no umlauts and check for charset! 
     */ 
    const SALT = '2o(xOXSjw WRQEh&#]c3t)X^z<h<4<g&6s,(-J(Y@XD'; 

    /** 
     * Minimum rehashing interations 
     * <= 0 deactivates 
     * Do NOT change when hashes have been generated! 
     */ 
    const ITERATIONS_MIN = 15; 

    /** 
     * Creates a MD5 hash from a string 
     *  
     * @param string $pwd 
     * @return string 
     */ 
    public static function hash($pwd) { 
         
        // Always hash once 
        $hash = md5($pwd . self::SALT); 
         
        if(self::ITERATIONS_MIN > 0) { 
             
            // Set minimum interations 
            $iter = self::ITERATIONS_MIN; 
             
            // Add variable iterations depending on first hash char. 
            $iter += (ord($hash[0]) % self::ITERATIONS_MIN); 
             
            // Rehash $iter times 
            while($iter-- > 1) { 
                $hash = md5($hash . self::SALT); 
            } 
        } 
        return $hash; 
    } 
     
} 
?>