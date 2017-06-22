<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\ClassificationBundle\Model\Category;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 */
class Post
{
	const POST_DRAFT = "draft";
	const POST_PUBLISHED = "published";

	/**
	 * @var int
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="title", type="string")
	 */
	private $title;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="slug", type="string")
	 */
	private $slug;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="content", type="text")
	 */
	private $content;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="created_at", type="datetime")
	 */
	private $created_at;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="last_modified", type="datetime")
	 */
	private $last_modified;

	/**
	 * @var bool
	 *
	 * @ORM\Column(name="comments_enabled", type="boolean")
	 */
	private $comments_enabled;

	/**
	 * @var bool
	 *
	 * @ORM\Column(name="status", type="string")
	 */
	private $status = self::POST_DRAFT;

	/**
	 * @var Category
	 *
	 * @ORM\ManyToOne(targetEntity="Application\Sonata\ClassificationBundle\Entity\Category")
	 * @ORM\JoinColumns({
	 *         @ORM\JoinColumn(name="category", referencedColumnName="id", nullable=true)
	 *     })
	 */
	private $category;

	/**
	 * Get id
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set title
	 *
	 * @param string $title
	 *
	 * @return Post
	 */
	public function setTitle($title)
	{
		$this->title = $title;

		return $this;
	}

	/**
	 * Get title
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Set slug
	 *
	 * @param string $slug
	 *
	 * @return Post
	 */
	public function setSlug($slug)
	{
		$this->slug = $slug;

		return $this;
	}

	/**
	 * Get slug
	 *
	 * @return string
	 */
	public function getSlug()
	{
		return $this->slug;
	}

	/**
	 * Set content
	 *
	 * @param string $content
	 *
	 * @return Post
	 */
	public function setContent($content)
	{
		$this->content = $content;

		return $this;
	}

	/**
	 * Get content
	 *
	 * @return string
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * Set createdAt
	 *
	 * @param \DateTime $createdAt
	 *
	 * @return Post
	 */
	public function setCreatedAt($createdAt)
	{
		$this->created_at = $createdAt;

		return $this;
	}

	/**
	 * Get createdAt
	 *
	 * @return \DateTime
	 */
	public function getCreatedAt()
	{
		return $this->created_at;
	}

	/**
	 * Set lastModified
	 *
	 * @param \DateTime $lastModified
	 *
	 * @return Post
	 */
	public function setLastModified($lastModified)
	{
		$this->last_modified = $lastModified;

		return $this;
	}

	/**
	 * Get lastModified
	 *
	 * @return \DateTime
	 */
	public function getLastModified()
	{
		return $this->last_modified;
	}

	/**
	 * Set commentsEnabled
	 *
	 * @param boolean $commentsEnabled
	 *
	 * @return Post
	 */
	public function setCommentsEnabled($commentsEnabled)
	{
		$this->comments_enabled = $commentsEnabled;

		return $this;
	}

	/**
	 * Get commentsEnabled
	 *
	 * @return boolean
	 */
	public function getCommentsEnabled()
	{
		return $this->comments_enabled;
	}

	/**
	 * Set category
	 *
	 * @param Category $category
	 *
	 * @return Post
	 */
	public function setCategory(Category $category = null)
	{
		$this->category = $category;

		return $this;
	}

	/**
	 * Get category
	 *
	 * @return Category
	 */
	public function getCategory()
	{
		return $this->category;
	}

	/**
	 * Set status
	 *
	 * @param string $status
	 *
	 * @return Post
	 */
	public function setStatus($status)
	{
		$this->status = $status;

		return $this;
	}

	/**
	 * Get status
	 *
	 * @return string
	 */
	public function getStatus()
	{
		return $this->status;
	}
}
