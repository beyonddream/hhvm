<?hh // partial

// This doc comment block generated by idl/sysdoc.php
/**
 * ( excerpt from http://php.net/manual/en/class.splobjectstorage.php )
 *
 * The SplObjectStorage class provides a map from objects to data or, by
 * ignoring data, an object set. This dual purpose can be useful in many
 * cases involving the need to uniquely identify objects.
 *
 */
class SplObjectStorage
  implements \HH\Iterator, Countable, Serializable, ArrayAccess {

  private $__storage = darray[];
  private $__key = 0;

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/splobjectstorage.rewind.php )
   *
   * Rewind the iterator to the first storage element.
   *
   * @return     mixed   No value is returned.
   */
  public function rewind() {
    $__storage = $this->__storage;
    reset(inout $__storage);
    $this->__storage = $__storage;
    $this->__key = 0;
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/splobjectstorage.valid.php )
   *
   * Returns if the current iterator entry is valid.
   *
   * @return     mixed   Returns TRUE if the iterator entry is valid, FALSE
   *                     otherwise.
   */
  public function valid() {
    $ret = key($this->__storage) !== NULL;
    return $ret;
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/splobjectstorage.key.php )
   *
   * Returns the index at which the iterator currently is.
   *
   * @return     mixed   The index corresponding to the position of the
   *                     iterator.
   */
  public function key() {
    return $this->__key;
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/splobjectstorage.current.php )
   *
   * Returns the current storage entry.
   *
   * @return     mixed   The object at the current iterator position.
   */
  public function current() {
    $obj = current($this->__storage)['obj'];
    return $obj;
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/splobjectstorage.next.php )
   *
   * Moves the iterator to the next object in the storage.
   *
   * @return     mixed   No value is returned.
   */
  public function next() {
    $__storage = $this->__storage;
    next(inout $__storage);
    $this->__storage = $__storage;
    $this->__key++;
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/splobjectstorage.count.php )
   *
   * Counts the number of objects in the storage.
   *
   * @return     mixed   The number of objects in the storage.
   */
  public function count() {
    return count($this->__storage);
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/splobjectstorage.contains.php )
   *
   * Checks if the storage contains the object provided.
   *
   * @obj        mixed   The object to look for.
   *
   * @return     mixed   Returns TRUE if the object is in the storage, FALSE
   *                     otherwise.
   */
  public function contains($obj) {
    if (gettype($obj) === 'object') {
      return isset($this->__storage[$this->getHashAndValidate($obj)]);
    }
    return false;
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/splobjectstorage.attach.php )
   *
   * Adds an object inside the storage, and optionally associate it to some
   * data.
   *
   * @obj        mixed   The object to add.
   * @data       mixed   The data to associate with the object.
   *
   * @return     mixed   No value is returned.
   */
  public function attach($obj, $data = null) {
    if (gettype($obj) === 'object') {
      $this->__storage[$this->getHashAndValidate($obj)] = darray[
        'obj' => $obj, 'inf' => $data
      ];
    }
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/splobjectstorage.detach.php )
   *
   * Removes the object from the storage.
   *
   * @obj        mixed   The object to remove.
   *
   * @return     mixed   No value is returned.
   */
  public function detach($obj) {
    if (gettype($obj) === 'object') {
      unset($this->__storage[$this->getHashAndValidate($obj)]);
    }
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from
   * http://php.net/manual/en/splobjectstorage.offsetexists.php )
   *
   * Checks whether an object exists in the storage.
   *
   * SplObjectStorage::offsetExists() is an alias of
   * SplObjectStorage::contains().
   *
   * @object     mixed   The object to look for.
   *
   * @return     mixed   Returns TRUE if the object exists in the storage,
   *                     and FALSE otherwise.
   */
  public function offsetExists($object) {
    return $this->contains($object);
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/splobjectstorage.offsetget.php )
   *
   * Returns the data associated with an object in the storage.
   *
   * @object     mixed   The object to look for.
   *
   * @return     mixed   The data previously associated with the object in
   *                     the storage.
   */
  public function offsetGet($object) {
    if (gettype($object) === 'object') {
      if (!$this->contains($object)) {
        throw new UnexpectedValueException('Object not found');
      }
      return $this->__storage[$this->getHashAndValidate($object)]['inf'];
    }
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/splobjectstorage.offsetset.php )
   *
   * Associate data to an object in the storage.
   *
   * SplObjectStorage::offsetSet() is an alias of
   * SplObjectStorage::attach().
   *
   * @object     mixed   The object to associate data with.
   * @data       mixed   The data to associate with the object.
   *
   * @return     mixed   No value is returned.
   */
  public function offsetSet($object, $data = null) {
    return $this->attach($object, $data);
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/splobjectstorage.offsetunset.php
   * )
   *
   * Removes an object from the storage.
   *
   * SplObjectStorage::offsetUnset() is an alias of
   * SplObjectStorage::detach().
   *
   * @object     mixed   The object to remove.
   *
   * @return     mixed   No value is returned.
   */
  public function offsetUnset($object) {
    return $this->detach($object);
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/splobjectstorage.removeall.php )
   *
   * Removes objects contained in another storage from the current storage.
   *
   * @storage    mixed   The storage containing the elements to remove.
   *
   * @return     mixed   No value is returned.
   */
  public function removeAll($storage) {
    $cache = varray[];
    foreach ($storage as $obj) {
      $cache[] = $obj;
    }
    foreach ($cache as $obj) {
      $this->detach($obj);
    }
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from
   * http://php.net/manual/en/splobjectstorage.removeallexcept.php )
   *
   * Removes all objects except for those contained in another storage from
   * the current storage.
   *
   * @storage    mixed   The storage containing the elements to retain in the
   *                     current storage.
   *
   * @return     mixed   No value is returned.
   */
  public function removeAllExcept($storage) {
    $cache = varray[];
    foreach ($this->__storage as $object) {
      if (!$storage->contains($object['obj'])) {
        $cache[] = $object['obj'];
      }
    }
    foreach ($cache as $object) {
      $this->detach($object);
    }
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/splobjectstorage.addall.php )
   *
   * Adds all objects-data pairs from a different storage in the current
   * storage.
   *
   * @storage    mixed   The storage you want to import.
   *
   * @return     mixed   No value is returned.
   */
  public function addAll($storage) {
    foreach ($storage as $object) {
      $this->attach($object);
    }
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/splobjectstorage.gethash.php )
   *
   * This method calculates an identifier for the objects added to an
   * SplObjectStorage object.
   *
   * The implementation in SplObjectStorage returns the same value as
   * spl_object_hash().
   *
   * The storage object will never contain more than one object with the
   * same identifier. As such, it can be used to implement a set (a
   * collection of unique values) where the quality of an object being unique
   * is determined by the value returned by this function being unique.
   *
   * @object     mixed   The object whose identifier is to be calculated.
   *
   * @return     mixed   A string with the calculated identifier.
   */
  public function getHash($object) {
    return spl_object_hash($object);
  }

  private function getHashAndValidate($object) {
    $hash = $this->getHash($object);
    if (!is_string($hash)) {
      throw new RuntimeException('Hash needs to be a string');
    }
    return $hash;
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/splobjectstorage.serialize.php )
   *
   * Returns a string representation of the storage.
   *
   * @return     mixed   A string representing the storage.
   */
  public function serialize() {
    return serialize($this->__storage);
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/splobjectstorage.unserialize.php
   * )
   *
   * Unserializes storage entries and attach them to the current storage.
   *
   * @serialized mixed   The serialized representation of a storage.
   *
   * @return     mixed   No value is returned.
   */
  public function unserialize($serialized) {
    $old = error_reporting();
    try {
      error_reporting(0);
      $arr = unserialize($serialized);
    } finally {
      if (error_reporting() === 0) {
        error_reporting($old);
      }
    }

    // check for error while unserializing.
    // we need to differentiate serialized(false) and false returned because of
    // a bad string
    if ($arr === false && serialize(false) !== $serialized) {
        throw new UnexpectedValueException('Error while unserializing');
    }

    if (is_array($arr)) {
      $this->__storage = $arr;
    }
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from http://php.net/manual/en/splobjectstorage.setinfo.php )
   *
   * Associates data, or info, with the object currently pointed to by the
   * iterator.
   *
   * @data       mixed   The data to associate with the current iterator
   *                     entry.
   *
   * @return     mixed   No value is returned.
   */
  public function setInfo($data) {
    $key = key($this->__storage);
    if ($key === null) {
      return;
    }
    $this->__storage[$key]['inf'] = $data;
  }


  /**
   * ( excerpt from http://php.net/manual/en/splobjectstorage.getinfo.php )
   *
   * Returns the data associated with the current iterator entry.
   *
   * @return     mixed   Returns the data, or info, associated with the
   *                     object pointed by the current iterator position.
   */
  public function getInfo() {
    $inf = current($this->__storage)['inf'];
    return $inf;
  }
}
