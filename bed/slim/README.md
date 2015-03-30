# Testing Slim Framework

## Authenticate Against IST ( Authn )

Request: /authn

- Method Post
- Basic Auth ( username and password )

Response:

- Content-Type JSON
- Get Sub-set of Party Data
- Get SMSESSION

## Donors

Request:

Response:


## Children

Request: /child/:id

- Method GET
- Headers SMSESSION

Response

- Content-Type JSON
- Get Child Detail Data

Request: /child/:id/media

- Method GET
- Headers SMSESSION

Response: 

- Content-Type JSON
- Get Child Detail Data
- Get Child Media

## Media

Request: /media/child/:id

- Method GET
- No SMSESSION Required

Response

- Content-Type JSON
- Get Child Media


Request: /media/project/:id

- Method GET
- No SMSESSION Required

Response

- Content-Type JSON
- Get Project Media