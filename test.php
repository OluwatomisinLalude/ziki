<?php 

/**
 * this file is to create a post file in your project
 * its for testing purposes only
 */

require 'vendor/autoload.php';
use Ziki\Core\Document;
$text = 'this is a test content Laborum cupidatat eiusmod duis duis. Sit voluptate ea fugiat duis velit Lorem culpa enim et ex. Magna pariatur dolor et Lorem Lorem non sint duis consequat elit consequat. Id culpa aliqua Lorem proident.

Nulla quis proident non excepteur quis tempor aliquip nostrud nulla nostrud dolore excepteur minim. Fugiat et ea non ipsum cupidatat duis. Do amet velit enim aliquip cillum. Non esse cillum sit dolore veniam et. Cupidatat cillum officia nisi elit aliqua culpa consequat culpa voluptate. Exercitation commodo aliquip ut mollit velit reprehenderit aliqua amet deserunt.

Mollit officia reprehenderit aliqua quis voluptate. Aliquip culpa magna et voluptate ullamco culpa adipisicing consequat enim minim cupidatat eu. Esse qui excepteur anim ipsum ut magna sint nisi. Consequat id in irure anim ex deserunt elit eu ipsum magna id ad. Nisi sit cupidatat amet excepteur veniam consectetur quis aute fugiat exercitation. Anim consectetur sunt commodo ut sit nisi sit exercitation commodo incididunt cillum.

Magna anim ad qui consequat excepteur voluptate ullamco aute. Quis consequat proident culpa nisi cillum in nulla occaecat laboris Lorem et et. Reprehenderit consequat incididunt ad ipsum et irure non. Duis aliqua mollit sunt ex fugiat non sint anim aliqua sint non in sunt. Do excepteur sit proident adipisicing elit esse veniam excepteur laborum excepteur anim esse proident aliquip.

Voluptate enim Lorem duis ipsum deserunt occaecat voluptate. Aliqua aute magna duis amet amet eu eu sint eiusmod. Cillum ullamco laboris reprehenderit reprehenderit esse. Veniam non sit amet voluptate excepteur id fugiat ad aute occaecat irure id. Eu reprehenderit officia sunt adipisicing consequat occaecat Lorem commodo.

Veniam enim consequat aliqua cupidatat sunt. Ullamco anim magna commodo cupidatat tempor laboris labore duis. Exercitation cillum aliquip qui duis est exercitation fugiat minim nulla reprehenderit cillum.

Tempor pariatur esse dolor esse velit cillum reprehenderit sunt ut dolore aliqua irure. Fugiat quis enim incididunt enim cillum dolor minim esse sit do in fugiat. Voluptate laboris dolor sunt quis culpa. Ex dolor eiusmod et ut ea aliquip ut non velit aute. Reprehenderit deserunt exercitation consequat minim velit qui consectetur nisi deserunt.

Occaecat aliqua dolor Lorem eiusmod do cillum eiusmod irure consequat aute consequat cupidatat eu. Et ipsum proident consectetur quis aliqua nisi velit pariatur est mollit laborum. Sint officia anim culpa dolor dolore incididunt esse in velit consequat proident quis officia. Ullamco officia elit amet commodo eu aliquip. Ea anim nostrud Lorem in elit ipsum aute ea. Reprehenderit ad nulla non non ipsum magna do magna in sit anim reprehenderit. Sint labore duis elit nisi cupidatat dolore id cillum pariatur Lorem ea sint elit.

Eu proident sunt excepteur incididunt laboris laboris laborum tempor nulla. Non excepteur qui commodo esse consequat est qui quis occaecat. Exercitation in do dolor veniam. Adipisicing nostrud et id reprehenderit. Tempor culpa consectetur pariatur eiusmod consequat non in qui ex.

Officia officia cillum sit qui veniam qui esse incididunt consequat esse excepteur anim. Esse enim incididunt eu elit. Laboris minim minim ad officia. Pariatur labore mollit quis ut id eiusmod voluptate proident deserunt consequat commodo. Nisi minim pariatur id fugiat non aute laboris id culpa culpa magna elit.';
$file_url = '/home/sphinx/ziki/storage/contents/1556628960.md';
$title = 'this is the title 1556714760';
$tags = 'tech,politics';
$image = 'jsojoss';
Document::updatePost($file_url,$title,$text,$tags,$image);
?>