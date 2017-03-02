add this to config/app providers (or replace the current HashServiceProvider):

```
Unamatasanatarai\Hashing\DropboxHashServiceProvider::class
```

Everything else works as it used to.


@todo:
======
-> needsRehash