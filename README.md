auth-token-query-param
===========================

HumHub module to allow authentica user through token string query parameter.

You need to configure _urlAuthServer_.

Your authenticator server must return a json with this structure:

```
{
    data:{
        user:{
            username: string
            email: string
            person:{
                firstName: string
                lastName: string
            }
        }
    }
}
```

With this info this module can create a new user if not present and/or logged in to HumHub.