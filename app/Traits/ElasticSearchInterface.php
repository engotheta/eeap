<?php namespace App\Traits;

	interface ElasticSearchInterface {

		public function getIndex();
		public function getType();
		public function getId();
		public function getBody();
		public function createIndex();

	}