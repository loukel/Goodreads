# Goodreads

Goodreads RSS reader, PHP class that has a function to return an array of each books' attributes on a specified shelf. The books can also be sorted.

## Purpose

Goodreads does have widgets that you can use but the design is limited and they are not dynamic so they will have to be manually updated. Goodreads also have RSS which I have used but the RSS files were very ugly and awkward to use, and so I created this Goodreads class to make it easier to dynamically add books to your web applications and therefore you can use Goodreads and the site is updated automatically as you add more books.

## Functionality

You can use any public shelf on your goodreads account by declaring the first parameter and you can also sort the shelf by declaring the second parameter in the shelf function.

## Installation

composer require loukel/goodreads </br>
composer install

OR

git clone https://github.com/loukel/Goodreads.git
