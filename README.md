Xi-Validate
===========

A collection of validators.
Feel free to make changes!

Hierarchy
=========

/library/Validate/Validate

    Generic validators that do not have any dependencies.
    These should extend ValidateAbstract..

/library/Validate/Validate/Zend

    Validators that extends Zend_Validate_Abstract.

/libary/Validate/Validate/Symfony

    Validators for Symfony.

etc.

Change log
==========

Versions are tagged.

v0.3
----

Updated Symfony Validator component to implement Symfony/Validate version 2.3 interfaces.

v0.2
----

Please note, that SocialSecurityNumberValidate is now called
FinnishSocialSecurityNumberValidate. The reason for this is to provide country
specific SSN validator with the country name as the prefix of the class name.
If your project is using old name and is returning Class Not Found excpetions
due to this change, please refactor your code to reflect the new validator class.

v0.1
----

Stuff before SocialSecurityNumberValidate localization refactoring.