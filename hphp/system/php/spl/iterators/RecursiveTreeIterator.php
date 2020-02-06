<?hh // partial

// This doc comment block generated by idl/sysdoc.php
/**
 * ( excerpt from http://php.net/manual/en/class.recursivetreeiterator.php
 * )
 *
 * Allows iterating over a RecursiveIterator to generate an ASCII graphic
 * tree.
 *
 */
class RecursiveTreeIterator extends RecursiveIteratorIterator
  implements OuterIterator {

  const int BYPASS_CURRENT = 4;
  const int BYPASS_KEY = 8;
  const int PREFIX_LEFT = 0;
  const int PREFIX_MID_HAS_NEXT = 1;
  const int PREFIX_MID_LAST = 2;
  const int PREFIX_END_HAS_NEXT = 3;
  const int PREFIX_END_LAST = 4;
  const int PREFIX_RIGHT = 5;

  private $flags;

  private $prefix = varray[
    "",    // PREFIX_LEFT
    "| ",  // PREFIX_MID_HAS_NEXT
    "  ",  // PREFIX_MID_LAST
    "|-",  // PREFIX_END_HAS_NEXT
    "\\-", // PREFIX_END_LAST
    "",    // PREFIX_RIGHT
  ];

  private $postfix = "";

  public function __construct(\HH\Traversable $it, $flags = null, $cit_flags = null,
                              $mode = null) {
    if ($flags === null) $flags = self::BYPASS_KEY;
    if ($mode === null) $mode = RecursiveIteratorIterator::SELF_FIRST;
    if ($cit_flags === null) $cit_flags = CachingIterator::CATCH_GET_CHILD;

    if ($it is \IteratorAggregate) {
      $it = $it->getIterator();
    }

    $this->flags = $flags;

    $cachingIterator = new RecursiveCachingIterator($it, $cit_flags);
    parent::__construct($cachingIterator, $mode);
  }

  public function setPrefixPart($part, $prefix) {
    if ($part < 0 || $part > 5) {
      throw new OutOfRangeException(
        "Use RecursiveTreeIterator::PREFIX_* constant"
      );
    }
    $this->prefix[$part] = (string)$prefix;
  }

  public function getPrefix() {
    $return = $this->prefix[self::PREFIX_LEFT];
    $depth = $this->getDepth();
    for ($i = 0; $i < $depth; ++$i) {
      $hasNext = $this->getSubIterator($i)->hasNext();
      if ($hasNext) {
        $return .= $this->prefix[self::PREFIX_MID_HAS_NEXT];
      } else {
        $return .= $this->prefix[self::PREFIX_MID_LAST];
      }
    }

    $hasNext = $this->getSubIterator($i)->hasNext();
    if ($hasNext) {
      $return .= $this->prefix[self::PREFIX_END_HAS_NEXT];
    } else {
      $return .= $this->prefix[self::PREFIX_END_LAST];
    }

    $return .= $this->prefix[self::PREFIX_RIGHT];
    return $return;
  }

  public function setPostfix($postfix) {
    $this->postfix = (string)$postfix;
  }

  public function getEntry() {
    $current = $this->getInnerIterator()->current();
    if (is_array($current)) {
      return "Array";
    } else {
      return (string)$current;
    }
  }

  public function getPostfix() {
    return $this->postfix;
  }

  public function current() {
    if ($this->flags & self::BYPASS_CURRENT) {
      $depth = $this->getDepth();
      return $this->getSubIterator($depth)->current();
    }

    $prefix = $this->getPrefix();
    $entry = $this->getEntry();
    return $prefix . $entry . $this->postfix;
  }

  public function key() {
    $depth = $this->getDepth();
    $it = $this->getSubIterator($depth);
    $key = $it->key();
    if ($this->flags & self::BYPASS_KEY) {
      return $key;
    }

    $prefix = $this->getPrefix();
    return $prefix . $key . $this->postfix;
  }

}
