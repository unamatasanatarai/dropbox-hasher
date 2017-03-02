<?php
namespace Unamatasanatarai\Hashing;

use Hash;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class DropboxHash implements HasherContract
{

    private $pepper = '1234098712340987';

    public function make($value, array $options = [])
    {
        $localPassword = openssl_digest(random_bytes(16), 'sha256', true);
        $localSalt = openssl_digest(random_bytes(16), 'sha256', false);

        $hashed = base64_encode(
            openssl_encrypt(
                $this->bcrypt($value, $localSalt),
                'aes-256-ctr',
                $localPassword,
                OPENSSL_RAW_DATA,
                $this->pepper
            )
        );

        return base64_encode($localPassword) . ':' . $localSalt . ':' . $hashed;
    }


    public function check($value, $hashedValue, array $options = [])
    {
        $parts = $this->decode($hashedValue);

        return Hash::check(
            $this->prehash($value, $parts['localSalt']),
            $parts['hashed']
        );
    }


    public function needsRehash($hashedValue, array $options = [])
    {
        return false;
    }


    public function setPepper($value)
    {
        $this->pepper = $value;
        return $this;
    }


    private function decode($hash)
    {
        list($localPassword, $localSalt, $hashed) = explode(':', $hash);
        $hashed = base64_decode($hashed);
        $localPassword = base64_decode($localPassword);
        $hashed = openssl_decrypt($hashed, 'aes-256-ctr', $localPassword, OPENSSL_RAW_DATA, $this->pepper);

        return [
            'localSalt'     => $localSalt,
            'hashed'        => $hashed,
            'localPassword' => $localPassword,
        ];
    }

    private function bcrypt($value, $salt)
    {
        return bcrypt($this->prehash($value, $salt));
    }


    /**
     * @param $value
     * @param $salt
     *
     * @return string
     */
    private function prehash($value, $salt)
    {
        return openssl_digest($value . $salt, 'sha512');
    }
}
