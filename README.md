php-fast-acl: Simple Access Control Lists
====================================

_A simple, dependency-free (in use) role and user-level access control system._

Installation
------------
You can clone the repository and work with the files directly, but everything is set up for composer, which makes it simple:

    composer require judikael971/php-basic-acl


Usage
-----
index.php
````php
<?php
require 'vendor/autoload.php';
$acl = new ACL();

//--
// Add roles
//--
$acl->addRole('admin');
$acl->addRole('editor');
$acl->addRole('guest');


//--
// Add resources
//--
$acl->addResource('Article', array('read', 'create', 'edit', 'delete', 'publish'));
$acl->addResource('Page', array('read', 'create', 'edit', 'delete', 'publish'));

//--
// Define acces control
//--

//-- Admin have all permissions
$acl->allow('admin', 'Article');
$acl->allow('admin', 'Page');

//-- Editor have all permissions
$acl->allow('editor', 'Article');
$acl->allow('editor', 'Page');

//-- Editor haven't permission to delete 'Article' et delete or publish 'Page'
$acl->deny('editor', 'Article', 'delete');
$acl->deny('editor', 'Page', array('delete', 'publish'));

//-- Guest have only 'read' permission
$acl->allow('guest', 'Article', 'read');
$acl->allow('guest', 'Page', 'read');

//--
// Test Acces
//--
?>
<ul>
    <li>Admin: <?php echo ($acl->isAllowed('admin', 'Article', 'read') ? 'have permission to ' : 'haven\'t permission to ') ?> read "Article"</li>
    <li>Admin: <?php echo ($acl->isAllowed('admin', 'Article', 'create') ? 'have permission to ' : 'haven\'t permission to ') ?> create "Article"</li>
    <li>Admin: <?php echo ($acl->isAllowed('admin', 'Article', 'edit') ? 'have permission to ' : 'haven\'t permission to ') ?> edit "Article"</li>
    <li>Admin: <?php echo ($acl->isAllowed('admin', 'Article', 'delete') ? 'have permission to ' : 'haven\'t permission to ') ?> delete "Article"</li>
    <li>Admin: <?php echo ($acl->isAllowed('admin', 'Article', 'publish') ? 'have permission to ' : 'haven\'t permission to ') ?> publish "Article"</li>
</ul>
<ul>
    <li>Admin: <?php echo ($acl->isAllowed('admin', 'Page', 'read') ? 'have permission to ' : 'haven\'t permission to ') ?> read "Page"</li>
    <li>Admin: <?php echo ($acl->isAllowed('admin', 'Page', 'create') ? 'have permission to ' : 'haven\'t permission to ') ?> create "Page"</li>
    <li>Admin: <?php echo ($acl->isAllowed('admin', 'Page', 'edit') ? 'have permission to ' : 'haven\'t permission to ') ?> edit "Page"</li>
    <li>Admin: <?php echo ($acl->isAllowed('admin', 'Page', 'delete') ? 'have permission to ' : 'haven\'t permission to ') ?> delete "Page"</li>
    <li>Admin: <?php echo ($acl->isAllowed('admin', 'Page', 'publish') ? 'have permission to ' : 'haven\'t permission to ') ?> publish "Page"</li>
</ul>
<ul>
    <li>Editor: <?php echo ($acl->isAllowed('editor', 'Article', 'read') ? 'have permission to ' : 'haven\'t permission to ') ?> read "Article"</li>
    <li>Editor: <?php echo ($acl->isAllowed('editor', 'Article', 'create') ? 'have permission to ' : 'haven\'t permission to ') ?> create "Article"</li>
    <li>Editor: <?php echo ($acl->isAllowed('editor', 'Article', 'edit') ? 'have permission to ' : 'haven\'t permission to ') ?> edit "Article"</li>
    <li>Editor: <?php echo ($acl->isAllowed('editor', 'Article', 'delete') ? 'have permission to ' : 'haven\'t permission to ') ?> delete "Article"</li>
    <li>Editor: <?php echo ($acl->isAllowed('editor', 'Article', 'publish') ? 'have permission to ' : 'haven\'t permission to ') ?> publish "Article"</li>
</ul>
<ul>
    <li>Editor: <?php echo ($acl->isAllowed('editor', 'Page', 'read') ? 'have permission to ' : 'haven\'t permission to ') ?> read "Page"</li>
    <li>Editor: <?php echo ($acl->isAllowed('editor', 'Page', 'create') ? 'have permission to ' : 'haven\'t permission to ') ?> create "Page"</li>
    <li>Editor: <?php echo ($acl->isAllowed('editor', 'Page', 'edit') ? 'have permission to ' : 'haven\'t permission to ') ?> edit "Page"</li>
    <li>Editor: <?php echo ($acl->isAllowed('editor', 'Page', 'delete') ? 'have permission to ' : 'haven\'t permission to ') ?> delete "Page"</li>
    <li>Editor: <?php echo ($acl->isAllowed('editor', 'Page', 'publish') ? 'have permission to ' : 'haven\'t permission to ') ?> publish "Page"</li>
</ul>
<ul>
    <li>Guest: <?php echo ($acl->isAllowed('guest', 'Article', 'read') ? 'have permission to ' : 'haven\'t permission to ') ?> read "Article"</li>
    <li>Guest: <?php echo ($acl->isAllowed('guest', 'Article', 'create') ? 'have permission to ' : 'haven\'t permission to ') ?> create "Article"</li>
    <li>Guest: <?php echo ($acl->isAllowed('guest', 'Article', 'edit') ? 'have permission to ' : 'haven\'t permission to ') ?> edit "Article"</li>
    <li>Guest: <?php echo ($acl->isAllowed('guest', 'Article', 'delete') ? 'have permission to ' : 'haven\'t permission to ') ?> delete "Article"</li>
    <li>Guest: <?php echo ($acl->isAllowed('guest', 'Article', 'publish') ? 'have permission to ' : 'haven\'t permission to ') ?> publish "Article"</li>
</ul>
<ul>
    <li>Guest: <?php echo ($acl->isAllowed('guest', 'Page', 'read') ? 'have permission to ' : 'haven\'t permission to ') ?> read "Page"</li>
    <li>Guest: <?php echo ($acl->isAllowed('guest', 'Page', 'create') ? 'have permission to ' : 'haven\'t permission to ') ?> create "Page"</li>
    <li>Guest: <?php echo ($acl->isAllowed('guest', 'Page', 'edit') ? 'have permission to ' : 'haven\'t permission to ') ?> edit "Page"</li>
    <li>Guest: <?php echo ($acl->isAllowed('guest', 'Page', 'delete') ? 'have permission to ' : 'haven\'t permission to ') ?> delete "Page"</li>
    <li>Guest: <?php echo ($acl->isAllowed('guest', 'Page', 'publish') ? 'have permission to ' : 'haven\'t permission to ') ?> publish "Page"</li>
</ul>
````
