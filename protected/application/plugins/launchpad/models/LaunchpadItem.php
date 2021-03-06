<?php
/*
 *    Copyright 2008-2009 Laurent Eschenauer and Alard Weisscher
 *    and Ryan Paul
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 *  
 */
class LaunchpadItem extends SourceItem {

	protected $_prefix 	= 'launchpad';
	
	protected $_preamble = 'Committed a revision: ';
	
	public function getContent() {
		return $this->_data['content'];
	}
	
	public function getTitle() {
		return html_entity_decode(strip_tags($this->_data['title']));
	}
	
	public function getLink() {
		return $this->_data['link'];
	}
	
	public function getType() {
		return SourceItem::OTHER_TYPE;
	}

	public function getBranch() {
		return $this->_data['branch'];
	}

	public function getRevno() {
		return $this->_data['revision'];
	}

	public function getProject() {
		return $this->_data['project'];
	}

	public function getMessage() {
		return $this->_data['message'];
	}

	public function getBranchURL() {
		return $this->_data['branch_url'];
	}
	
	public function getBackup() {
		$item = array();
		$item['Link']				= $this->getLink();
		$item['Title']				= $this->_data['title'];
		$item['Content']			= $this->_data['content'];
		$item['Date']				= $this->_data['published'];		
		return $item;
	}
	
	public function setTitle($title) {
		$db = Zend_Registry::get('database');
		
		$sql = "UPDATE `launchpad_data` SET `title`=:title "
			 . "WHERE source_id = :source_id AND id = :item_id ";
		
		$data 		= array("source_id" 	=> $this->getSource(),
							"item_id"		=> $this->getID(),
							"title"			=> $title);
							
 		$stmt 	= $db->query($sql, $data);

 		return;
	}
	
	public function setContent($content) {
		$db = Zend_Registry::get('database');
		
		$sql = "UPDATE `launchpad_data` SET `content`=:content "
			 . "WHERE source_id = :source_id AND id = :item_id ";
		
		$data 		= array("source_id" 	=> $this->getSource(),
							"item_id"		=> $this->getID(),
							"content"		=> $content);
							
 		$stmt 	= $db->query($sql, $data);

 		return;
	}
}
