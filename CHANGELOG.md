# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

- Nothing.

## [0.1.1] - 2018-01-25

- Added the `IN` list comparison operator.
- Added temporary `AmbiguousComponent` for cases where syntax isn't implemented by the library.

## [0.1.0] - 2018-01-25

### Added
- Added `RETURN` [clause](http://neo4j.com/docs/developer-manual/current/cypher/clauses/) and improved developer experience.
- Added `StatementBuilder` and `WITH` [clause](http://neo4j.com/docs/developer-manual/current/cypher/clauses/).
- Added `QueryBuilder` and helpers `PathHelper` and `NodeHelper`.
- Added `=`, `<>`, `>`, `>=`, `<`, `<=` logical [operators](http://neo4j.com/docs/developer-manual/current/cypher/syntax/operators/).
- Added `AND`, `OR`, `NOT` comparison [operators](http://neo4j.com/docs/developer-manual/current/cypher/syntax/operators/).
- Added `MATCH` and `WHERE` [clauses](http://neo4j.com/docs/developer-manual/current/cypher/clauses/).
- Added `Path`, `Node`, `RelationshipNode` and `Relationship`. 
The ability to build almost any series of relation is available minus the ability to [define variable length pattern matching](https://neo4j.com/docs/developer-manual/current/cypher/syntax/patterns/#cypher-pattern-varlength) which looks easy to implement but is not high priority for me right now.
Besides that everything that is mentioned on the developer manual under [pattern syntax](https://neo4j.com/docs/developer-manual/current/cypher/syntax/patterns/) should be possible.
- Added minimal amount of Cypher components to get a proof of concept.
- Added basic concepts around this idea of a `AbstractComponent` that can be converted to string. From this all component parts of the Cypher syntax can be created.
- Added `Makefile` and `PHP` code formatting/monitoring tools.
- Added standard `gitignore` and `gitattributes`.
