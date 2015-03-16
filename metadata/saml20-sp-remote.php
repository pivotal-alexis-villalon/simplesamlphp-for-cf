<?php
/**
 * SAML 2.0 remote SP metadata for simpleSAMLphp.
 *
 * See: https://simplesamlphp.org/docs/stable/simplesamlphp-reference-sp-remote
 */

/*
 * Example simpleSAMLphp SAML 2.0 SP
 */
$metadata['https://saml2sp.example.org'] = array(
	'AssertionConsumerService' => 'https://saml2sp.example.org/simplesaml/module.php/saml/sp/saml2-acs.php/default-sp',
	'SingleLogoutService' => 'https://saml2sp.example.org/simplesaml/module.php/saml/sp/saml2-logout.php/default-sp',
);

$metadata['cloudfoundry-saml-login'] = array(
    'AssertionConsumerService' => 'http://localhost:8080/uaa/saml/SSO/alias/cloudfoundry-saml-login',
    'SingleLogoutService' => 'http://localhost:8080/uaa/saml/SSO/alias/cloudfoundry-saml-login',
    'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress',
    'simplesaml.nameidattribute' => 'emailAddress',
);

$metadata['login.10.244.0.34.xip.io'] = array(
    'AssertionConsumerService' => 'http://login.10.244.0.34.xip.io/saml/SSO/alias/login.10.244.0.34.xip.io',
    'SingleLogoutService' => 'http://login.10.244.0.34.xip.io/saml/SSO/alias/login.10.244.0.34.xip.io',
    'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress',
    'simplesaml.nameidattribute' => 'emailAddress',
);

$metadata['testzone1.login.10.244.0.34.xip.io'] = array(
    'AssertionConsumerService' => 'http://testzone1.login.10.244.0.34.xip.io/saml/SSO/alias/testzone1.login.10.244.0.34.xip.io',
    'SingleLogoutService' => 'http://testzone1.login.10.244.0.34.xip.io/saml/SSO/alias/testzone1.login.10.244.0.34.xip.io',
    'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress',
    'simplesaml.nameidattribute' => 'emailAddress',
);

$metadata['testzone1.cloudfoundry-saml-login'] = array(
    'AssertionConsumerService' => 'http://testzone1.localhost:8080/uaa/saml/SSO/alias/testzone1.cloudfoundry-saml-login',
    'SingleLogoutService' => 'http://testzone1.localhost:8080/uaa/saml/SSO/alias/testzone1.cloudfoundry-saml-login',
    'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress',
    'simplesaml.nameidattribute' => 'emailAddress',
);

/*
 * This example shows an example config that works with Google Apps for education.
 * What is important is that you have an attribute in your IdP that maps to the local part of the email address
 * at Google Apps. In example, if your google account is foo.com, and you have a user that has an email john@foo.com, then you
 * must set the simplesaml.nameidattribute to be the name of an attribute that for this user has the value of 'john'.
 */
$metadata['google.com'] = array(
	'AssertionConsumerService' => 'https://www.google.com/a/g.feide.no/acs',
	'NameIDFormat' => 'urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress',
	'simplesaml.nameidattribute' => 'uid',
	'simplesaml.attributes' => FALSE,
);
