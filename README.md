Supah Framework
======================

The minimalistic PHP framework that will make you die of boredom.

This is one of the most strange frameworks you're going to be playing with, since it takes a slightly different approach than the typical MVC.

My (shit) interpretation goes as follows:
* Routes - These basically take the passed URI structure (ex: /route/blah/blah/blah) and process it accordingly.
* Controllers - These control the output of the page, accessed by one of the routes.
* Templates - The basic architecture for web pages, replaced with dynamic data.  Otherwise known as the V in MVC (View).
* Scripts - They're callbacks, **not asynchronous callbacks**, but just execute repetitive or long lines of code and return data possibly.

It currently has an abstract database API and utility methods.

How to use
======================
TODO

License
======================

GNU General Public License, version 2 (GPL-2.0)

See LICENSE.txt for more information.