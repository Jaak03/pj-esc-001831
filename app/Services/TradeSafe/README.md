# TradeSafe Service #
## GraphQL ##
I have had a look around and for now I am planning on using the [bendeckdavid/graphql-client](https://github.com/bendeckdavid/graphql-client) package. This was suggested in [this](https://www.freecodecamp.org/news/build-a-graphql-api-using-laravel/) guide from freecodecamp.org, and it seems to be the most active package 
from what I have seen so far.

> 💡 This might change in the future so I am going to create the package to allow for swapping out the GraphQL package 
> later if we find that the current one does not work.

## Commands ##
### List tokens ###
[List tokens](https://developer.tradesafe.co.za/docs/1.3/api/tokens#list) is a basic query that lists the tokens 
that you have registered on TradeSafe for the application. This is an entity that is used as the subject of 
transactions on the platform. It is generated as part of the signup process.

```graphql
query tokens {
    tokens {
        data {
            id
            name
            reference
            user {
                givenName
                familyName
                email
                mobile
            }
            organization {
                name
                tradeName
                type
                registration
                taxNumber
            }
        }
    }
}
```
