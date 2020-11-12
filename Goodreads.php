<?php
class Goodreads {
  private $rss_link = 'https://www.goodreads.com/review/list_rss/';
  function __construct($id) {
    /**
     * Adds the users id to the RSS link
     * 
     * @param string $id end of profile link eg. 123456789-bob
    */
    $this->rss_link = $this->rss_link . $id;
  }

  function shelf($shelf_name, $sort=null, $order=null) {
    /**
     * Returns a 2d array: first indexed, second associative, which contains the chosen shelf of books from Goodreads
     * 
     * @param string $shelf_name Name of the shelf: read, to-read, currently-reading and any other created shelf
     * @param string $sort [Optional] How the shelf is to be sorted: title, author, avg_rating, rating, review, date_read, date_added
     * @param string $oder [Optional] the order of the sort either 'a' or 'd'
    */
    $shelf_rss_link = $this->rss_link . '?shelf=' . $shelf_name . (!empty($sort) ?'&sort=' . $sort : $sort) . (!empty($order) ?'&order=' . $order : $order);
    $rss = new DOMDocument();
    $rss->load($shelf_rss_link);

    $shelf = array();
    foreach ($rss->getElementsByTagName('item') as $book_info) {
      // Gather each book's attributes
      // Attributes may contain tags
      $book_title =  $book_info->getElementsByTagName('title')->item(0)->nodeValue;
      $desc = $book_info->getElementsByTagName('book_description')->item(0)->nodeValue;
      $author = $book_info->getElementsByTagName('author_name')->item(0)->nodeValue ;
      $link = $book_info->getElementsByTagName('link')->item(0)->nodeValue ;
      $s_cover = $book_info->getElementsByTagName('book_small_image_url')->item(0)->nodeValue;
      $m_cover = $book_info->getElementsByTagName('book_medium_image_url')->item(0)->nodeValue;
      $l_cover = $book_info->getElementsByTagName('book_large_image_url')->item(0)->nodeValue;
      $pages = $book_info->getElementsByTagName('num_pages')->item(0)->nodeValue;
      $isbn = $book_info->getElementsByTagName('isbn')->item(0)->nodeValue;
      $published = $book_info->getElementsByTagName('book_published')->item(0)->nodeValue;
      $avg_rating = $book_info->getElementsByTagName('average_rating')->item(0)->nodeValue;
      $user_rating = $book_info->getElementsByTagName('user_rating')->item(0)->nodeValue;
      $user_review = $book_info->getElementsByTagName('user_review')->item(0)->nodeValue;
      
      // Attributes not included: guid, pubDate, book_id, read at, language
      $book = array(
        'Title' => $book_title,
        'Description' => $desc,
        'Author' => $author,
        'Link' => $link,
        'Small Cover' => $s_cover,
        'Medium Cover' => $m_cover,
        'Large Cover' => $l_cover,
        'Pages' => $pages,
        'ISBN' => $isbn,
        'Published' => $published,
        'Average Rating' => $avg_rating,
        'User Rating' => $user_rating,
        'User Review' => $user_review
      );

      array_push($shelf, $book);
    }
    return $shelf;
  }
}
/*
Example:
$gr = new Goodreads('123456789-bob');
$read_shelf = $gr->shelf('read', 'rating');
echo $read_shelf[0]['User Rating']
*/
?>