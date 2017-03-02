```
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = (new DropboxHash)->make($value);
        dd((new DropboxHash())->check($value, $this->attributes['password']));
    }
```


add this to config/app provicers (or replace the current HashServiceProvider):

```Unamatasanatarai\Hashing\DropboxHashServiceProvider::class```