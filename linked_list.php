<?php
class Node {
	public $value;
	public $next;
	public $previous;
	public function __construct($value) {
		$this->value = $value;
	}
}

class DoublyLinkedNode {
	public $head;
	public $tail;

	public function add($value) {
		$node = new Node($value);	
		if($this->head == NULL && $this->tail == NULL) {
			$this->head = $node;
			$this->tail = $node;
			return $this;
		} else {
			$this->tail->next = $node;
			$node->previous = $this->tail;
			$this->tail = $node;
			return $this;
		}
	}

	public function delete($del) {
		if($del == $this->head->value) {
			$this->head = $this->head->next;
			return $this;
		} elseif ($del == $this->tail->value) {
			$temp = $this->tail->previous;
			unset($this->tail);
			$this->tail = $temp;
			$this->tail->next = NULL;
			return $this;
		} else {
			$runner = $this->head->next;
			while ($runner->value != $del) {
				$runner = $runner->next;
			}
			$nxt = $runner->next;
			$prv = $runner->previous;
			$runner->next->previous = $prv;
			$runner->previous->next = $nxt;
			return $this;
		}
	}

	public function insert($current, $new) {
		$node = new Node($new);
		$runner = $this->head->next;
		while ($runner->value != $current) {
			$runner = $runner->next;
		}
		$node->next = $runner->next;
		$node->previous = $runner;
		$runner->next->previous = $node;
		$runner->next = $node;
	}

	public function display_list() {
		if($this->head != NULL) {
			$node = $this->head;
			while ($node != NULL) {
				echo $node->value.' ';
				$node= $node->next;
			}
		}
	}
}

$list = new DoublyLinkedNode();
$list->add(10)->add(12)->add(33)->add(22);
echo ('<h2>These are the results after adding node(s):</h2>');
$list->display_list();

$list->delete(22);
echo ('<h2>This is the result after deleting node:</h2>');
$list->display_list();

$list->insert(12, 27);
echo('<h2>This is the new list after insertion of new node:</h2>');
$list->display_list();
?>