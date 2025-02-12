# Studievereniging Concat Website
This repository contains the source code for the website of the Concat Study Association

## Coding Guidelines
To maintain a clean and consistent codebase, we adhere to the following coding guidelines:

### 1. PHP CodeSniffer
We use [PHP CodeSniffer](https://github.com/PHPCSStandards/PHP_CodeSniffer/) to enforce the [PEAR](https://pear.php.net/manual/en/standards.php) coding standard. Make sure to run PHP CodeSniffer before committing your code to check for any violations.

### 2. Clean Code Principles
In order to keep our code readable, reusable, and refactorable, we follow the clean code principles outlined in [Clean Code PHP](https://github.com/piotrplenik/clean-code-php). While PHP CodeSniffer helps enforce coding standards and detect formatting issues, it does not check for the actual meaning or clarity of elements like variable names or function descriptions. 

</br> **Important:** In cases where there is overlap between the concepts covered by both PHP CodeSniffer and Clean Code PHP, the rules enforced by PHP CodeSniffer take priority.

### 3. Branch Naming Conventions
**Use Separators** <br/>
Always use separators such as hyphens (-) or slashes (/) to improve readability in branch names. Maintain consistency with the chosen separator across all branches.

    Example: optimize-data-analysis or optimize/data/analysis

**Start Name with a Category Word** </br>
Branch names should begin with with a category word, which indicates the type of task that is being solved with that branch.
| Category  | Meaning                                                                    |
| --------- | -------------------------------------------------------------------------- |
| `hotfix`  | for quickly fixing critical issues,  <br>usually with a temporary solution |
| `bugfix`  | for fixing a bug                                                           |
| `feature` | for adding, removing or modifying a feature                                |
| `test`    | for experimenting something which is not an issue                          |
| `wip`     | for a work in progress                                                     |

**Include the Issue ID** </br>
Append the related issue ID to the branch name to make it easier to identity and keep track of its progress.

    Example: wip-451-optimize-data-analysis

## Managing Issues
1. **Search Existing Issues**: Before creating a new issue, search the existing issues to see if a similar issue has already been reported.
2. **Create a New Issue**: If the issue hasn't been reported yet, create a new one with a clear and descriptive title. Then, create a branch specifically for that issue and link the issue to the branch.
3. **Provide Details**: Include as much detail as possible in the issue description, including steps to reproduce the issue, expected behavior, and actual behavior.
4. **Label the Issue**: Apply appropriate labels to the issue to help categorize and prioritize it.

## Development
### 1. Prerequisites
- PHP 8.4 or higher
- Laravel Herd 1.14.0 or higher

### 2. Steps
TDB

## Comments
TBD

## Testing
TBD
