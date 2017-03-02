```
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
        dd(\Hash::check($value, $this->attributes['password']));
    }
```


add this to config/app providers (or replace the current HashServiceProvider):

```
Unamatasanatarai\Hashing\DropboxHashServiceProvider::class
```
