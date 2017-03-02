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
-> needsRehash




