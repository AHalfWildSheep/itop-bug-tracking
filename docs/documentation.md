# AHWS Bug Tracker Extension - Complete Datamodel Documentation


## Introduction

This bug tracker extension is an issue tracking solution built for iTop CMDB. It provides organizations with the tools needed to manage software bugs, feature requests, and general tasks throughout their development lifecycle.

This extension integrates seamlessly with iTop's existing infrastructure using custom classes name.

## Architecture Overview

The extension follows iTop's standard class hierarchy and extends the `cmdbAbstractObject` base class.

## Data Model

### Entity Relationship Overview

```
AHWSIssue (*) <--> (1) AHWSProduct
AHWSIssue (*) <--> (1) AHWSComponent (optional)
AHWSIssue (*) <--> (1) AHWSMilestone (optional)
AHWSIssue (*) <--> (*) AHWSProductVersion (LnkAHWSIssueToAHWSProductVersion)
AHWSIssue (*) <--> (1) AHWSIssue (parent, optional)
AHWSProduct (1) <--> (*) AHWSComponent
AHWSProduct (1) <--> (*) AHWSProductVersion
AHWSProduct (1) <--> (*) AHWSMilestone

```
## Class Definitions

### AHWSIssue

The core class representing individual issues, bugs, enhancements, or tasks.

| Attribute | Type | Mandatory | Description |
|-----------|------|----------|-------------|
| summary | String | Yes | Brief description of the issue |
| reference | String | No | Unique identifier in format "ISSUE-#####" |
| status | Enum | Yes | Current state in the lifecycle (unconfirmed, confirmed, inprogress, resolved, closed) |
| type | Enum | Yes | Classification as bug, enhancement, or task |
| description | HTML | Yes |  Detailed description of the issue |
| keywords | TagSet | No | Searchable tags for categorization |
| priority | Enum | No | Business priority (P1-P4) |
| severity | Enum | No | Technical severity (S1-S4) |
| product_id | External Key | Yes | Associated product |
| component_id | External Key | No | Specific component within the product |
| version | LinkedSet | No | Affected versions |
| milestone_id | External Key | No | Target milestone for resolution |
| reporter_id | External Key | Yes | Person who reported the issue |
| team_id | External Key | No | Responsible team |
| assignee_id | External Key | No | Individual assigned to the issue |
| parent_issue_id | Hierarchical Key | No | Parent issue |
| issue_log | CaseLog | No | Audit trail of all changes and comments |
| creation_date | DateTime | No | When the issue was created |
| update_date | DateTime | No | Last modification time |
| resolution_date | DateTime | No | When the issue was resolved |
| resolution_code | Enum | No | Reason for resolution (fixed, duplicate, wontfix, notreproduced)|


### AHWSProduct

Represents software products or applications being tracked.

| Attribute | Type | Mandatory | Description |
|-----------|------|----------|-------------|
| name | String | Yes |Product name |
| description | HTML | No | Detailed product description |
| status | Enum | Yes | Active or inactive status (active, inactive) |
| components_list | LinkedSet | No | All components belonging to this product |
| versions_list | LinkedSet | No | All versions of this product |

### AHWSProductVersion

Represents specific versions or releases of products.

| Attribute | Type | Mandatory  | Description |
|-----------|------|-----------|-----------|
| name | String | Yes | Version identifier (e.g. "v2.1.3") |
| status | Enum | Yes | Active or inactive status |
| product_id | External Key | Yes | Parent product |
| release_date | DateTime | No | When this version was or will be released |


### AHWSComponent

Represents modular components within products.

| Attribute | Type | Mandatory | Description |
|-----------|------|----------|-------------|
| name | String | Yes | Component name |
| product_id | External Key | Yes |Parent product |
| product_name | External Field | Auto-populated| Product name from parent |
| description | HTML | No | Component details |

### AHWSMilestone

Represents project milestones or release targets.

| Attribute | Type | Mandatory  | Description |
|-----------|------|-----------|-------------|
| name | String | Yes  | Milestone name |
| product_id | External Key | Yes | Associated product |
| description | HTML | No | Milestone details |
| start_date | Date | No |  Milestone start date |
| due_date | Date | No |  Target completion date |
| issues_list | LinkedSet | No | All issues assigned to this milestone |
