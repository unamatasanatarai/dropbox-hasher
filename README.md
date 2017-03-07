1.
====
Feel free to set your own pepper
```
app('hash')->setPepper(16-bytes);
```

2.
====

add this to config/app providers (or replace the current HashServiceProvider):

```
Unamatasanatarai\Hashing\DropboxHashServiceProvider::class
```

Everything else works as it used to.


```
"require": {
    "unamatasanatarai/dropbox-hasher": "dev-master"
},
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/unamatasanatarai/dropbox-hasher.git"
    }
],
```

@todo:
======
- needsRehash
- automate pepper setting, maybe in the service provider?




