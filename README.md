```
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = (new DropboxHash)->make($value);
        dd((new DropboxHash())->check($value, $this->attributes['password']));
    }
```
