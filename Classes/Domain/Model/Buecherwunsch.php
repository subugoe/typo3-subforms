<?php
namespace Subugoe\Subforms\Domain\Model;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Ingo Pfennigstorf <pfennigstorf@sub-goettingen.de>
 *      Goettingen State Library
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

/**
 * Buecherwunsch
 */
class Buecherwunsch extends Form
{

    /**
     *
     * @validate NotEmpty
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $author;

    /**
     * @var string
     */
    protected $editor;

    /**
     * @validate NotEmpty, NumberRange(startRange=1000, endRange=2050)
     * @var int
     */
    protected $publishingYear;

    /**
     * @var int
     */
    protected $issue;

    /**
     * @var string
     */
    protected $isbn;

    /**
     * @var string
     */
    protected $additionalData;

    /**
     * @validate NotEmpty
     * @var string
     */
    protected $name;

    /**
     * @validate NotEmpty
     * @var string
     */
    protected $userId;

    /**
     * @validate EmailAddress, NotEmpty
     * @var string
     */
    protected $emailAddress;

    /**
     *
     * @validate notEmpty
     * @var string
     */
    protected $neededFor;

    /**
     * @validate NotEmpty
     * @var string
     */
    protected $deadline;

    /**
     * @validate NotEmpty
     * @var string
     */
    protected $tutor;

    /**
     * @validate NotEmpty
     * @var string
     */
    protected $faculty;

    /**
     * @validate NotEmpty
     * @var string
     */
    protected $instituteName;

    /**
     * @var string
     */
    protected $remarks;

    /**
     * @return string
     */
    public function getAdditionalData()
    {
        return $this->additionalData;
    }

    /**
     * @param string $additionalData
     */
    public function setAdditionalData($additionalData)
    {
        $this->additionalData = $additionalData;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * @param string $deadline
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    }

    /**
     * @return string
     */
    public function getEditor()
    {
        return $this->editor;
    }

    /**
     * @param string $editor
     */
    public function setEditor($editor)
    {
        $this->editor = $editor;
    }

    /**
     * @return string
     */
    public function getFaculty()
    {
        return $this->faculty;
    }

    /**
     * @param string $faculty
     */
    public function setFaculty($faculty)
    {
        $this->faculty = $faculty;
    }

    /**
     * @return string
     */
    public function getInstituteName()
    {
        return $this->instituteName;
    }

    /**
     * @param string $instituteName
     */
    public function setInstituteName($instituteName)
    {
        $this->instituteName = $instituteName;
    }

    /**
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    /**
     * @return int
     */
    public function getIssue()
    {
        return $this->issue;
    }

    /**
     * @param int $issue
     */
    public function setIssue($issue)
    {
        $this->issue = $issue;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getNeededFor()
    {
        return $this->neededFor;
    }

    /**
     * @param string $neededFor
     */
    public function setNeededFor($neededFor)
    {
        $this->neededFor = $neededFor;
    }

    /**
     * @return int
     */
    public function getPublishingYear()
    {
        return $this->publishingYear;
    }

    /**
     * @param int $publishingYear
     */
    public function setPublishingYear($publishingYear)
    {
        $this->publishingYear = $publishingYear;
    }

    /**
     * @return string
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * @param string $remarks
     */
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTutor()
    {
        return $this->tutor;
    }

    /**
     * @param string $tutor
     */
    public function setTutor($tutor)
    {
        $this->tutor = $tutor;
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}
