# Usage

Available commands:

* [doc](#the-doc-command)
* [doc:bundle](#the-docbundle-command)

The documentation commands use [skeletons](../skeletons) to create the
following files:

* `CHANGELOG.md`
* `CONTRIBUTING.md`
* `README.md`
* `VERSIONING.md`
* `bin/installer.sh`
* `doc` (or `Resources/doc` if the project is a bundle) directory:
    - `01-introduction.md`
    - `02-installation.md`
    - `03-usage.md`
    - `04-tests.md`

## The `doc` command

You can see the synopsis of this command by running:

    fossil doc --help

### Arguments

* `github-repository`: used to create links to github,
  should be in the following format: `username/repository-name`
* `author`: used for the license's copyright

### Options

* `--path` (or `-p`): used to write the files,
  the default is the current directory

### Heads up!

You can run this command using its shortcut: `fossil d`

Example:

    fossil d 'acme/demo-bundle' 'The ACME company'

## The `doc:bundle` command

You can see the synopsis of this command by running:

    fossil doc:bundle --help

### Arguments

* `github-repository`: used to create links to github,
  should be in the following format: `username/repository-name`
* `author`: used for the license's copyright
* `fully-qualified-classname`: used to register the bundle in the application's
  kernel (put this argument inside quotes, the shell won't like the `\`)

### Options

* `--path` (or `-p`): used to write the files,
  the default is the current directory
* `--composer-package` (or `-c`): used for the installation's documentation and
  script, by default is the same as the `github-repository` argument
* `--is-development-tool` (or `-d`): used to register the bundle in the
  application's in development and test environments

### Heads up!

You can run this command using its shortcut: `fossil d:b`

Example:

    fossil d:b 'acme/demo-bundle' 'The ACME company' 'Acme\DemoBundle\AcmeDemoBundle'

## Previous readings

* [introduction](01-introduction.md)
* [installation](02-installation.md)
