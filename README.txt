# Users Manual

## The Semantic Web

This extension enables you to consume and expose data of/to the Linked Data cloud within yout TYPO3 installation. If you are not familiar with the conceptional ideas behind the Semantic Web you might want to read the [Wikipedia article](http://en.wikipedia.org/wiki/Semantic_Web) first.

By now the extension provides the following features:

- a SPARQL Content Element where an editor selects a SPARQL query to be executed and chooses an appropriate layout
- an administrator plugin to write and test SPARQL queries in the front-end
- code highlighting for the SPAQL queries and Fluid templates (front-end and back-end)
- a query result cache (a result gets cached and is available even if the SPARQL endpoint is offline)
- default set of RDF namespaces

For a list of planned features visit the [product backlog](http://forge.typo3.org/rb/master_backlogs/extension-semantic) on our project site.

## Installation

1.  Install the extension in the extension manager as usual.
1.  Don't forget to include the static template(s).
1.  Put one of the SPARQL plugins on a page (eg. "SPAQL Admin") and specify a Starting Point (the page you want to store your data on).
1.  Reload.

## What's next?

* Learn about the Resource Description Framework (RDF): <http://rdfabout.com/intro/?section=contents> .
* Learn how to write SPARQL queries: <http://www.cambridgesemantics.com/2008/09/sparql-by-example/> .
* Contribute to the project by testing and writing code or documentation.
* Have some great ideas and share them.

## Known limitations

* The Extension is still alpha. That means that the API is not yet stable.