Author: Joris Jacobs, Robin Moors
Date: 13/10/2012

In order to enable login with an eID we have implemented eID Identity Provider
--> http://eid.belgium.be/nl/eid-toepassingen_ontwikkelen/eid-bouwstenen/eID_identity_provider/
The eID Identity Provider is a simple IdP using the eID as authentication token. The eID IdP supports different authentication protocols:
see --> https://www.e-contract.be/eid-idp-sp/
- SAML v2 browser POST profile
- OpenID 2.0 with AX, PAPE, UI extension support
- WS-Federation

We have worked with lightOpenID and downloaded lightopenid-0.6.tar from http://code.google.com/p/lightopenid/downloads/list
This contains example-google.php, example.php and openid.php. Only the api is implemented in this project.

example-google.php: this allows you to login to your google account and isn't used in this program.
The example is giving because it also is a form/sort of openid. Check http://www.openid.net
example.php: this allows you read your eID and uses the function from openid.php
openid.php: this is the API to read the eID

The example redirects to the applet on https://www.e-contract.be/products.html for entity authentication


Test your openid attributes (OP AX fetch) on
--> http://test-id.org/OP/AXFetch.aspx
openID Identifier for google: https://www.google.com/accounts/o8/id
openID Identifier for eID: https://www.e-contract.be/eid-idp/endpoints/openid/auth

At the time (13/10/2012) it isn't possible to retrieve the photo for webapplication.