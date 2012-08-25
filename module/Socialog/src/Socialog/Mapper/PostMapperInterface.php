<?php

namespace Socialog\Mapper;

interface PostMapperInterface {
	
	public function findAllPosts();
	public function findById($id);
	
}