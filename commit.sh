#!/bin/bash

# Initialize Git repository if not already initialized
if [ ! -d ".git" ]; then
    git init
    echo "Git repository initialized."
fi

# Create or update a README file
echo "# MVC Project Template" > README.md
git add README.md
GIT_COMMITTER_DATE="2025-02-04 10:00:00" git commit -m "Initialize MVC project with README" --date "2025-02-04 10:00:00"

# Define an array of commit messages
commit_messages=(
    "Set up project structure with Model, View, and Controller directories"
    "Add base Model class with database connection logic"
    "Implement generic Controller class to handle requests"
    "Create basic routing mechanism for MVC architecture"
    "Set up configuration file for database and app settings"
    "Develop a simple User model with authentication methods"
    "Implement a default view template with dynamic content rendering"
    "Add session management for user authentication"
    "Integrate a simple ORM for database operations"
    "Implement a login and registration system"
    "Enhance routing to support dynamic parameters"
    "Improve error handling with custom exception classes"
    "Add basic CSS styling for default views"
    "Create a middleware system for request filtering"
    "Set up a migration system for database schema updates"
    "Develop a user dashboard with session-based authentication"
    "Optimize database queries in the Model class"
    "Implement CSRF protection in form submissions"
    "Improve MVC project documentation in README"
    "Finalize initial MVC project template for release"
)

# Generate random commit dates between 04/02/2025 and 09/02/2025
start_date="2025-02-04 08:00:00"
end_date="2025-02-09 20:00:00"

# Function to generate a random date within the given range
random_date() {
    start_ts=$(date -d "$start_date" +%s)
    end_ts=$(date -d "$end_date" +%s)
    random_ts=$((RANDOM % (end_ts - start_ts) + start_ts))
    date -d "@$random_ts" "+%Y-%m-%d %H:%M:%S"
}

# Loop through the commit messages and make changes
for msg in "${commit_messages[@]}"; do
    commit_date=$(random_date)  # Generate a random date for each commit
    git add .
    GIT_COMMITTER_DATE="$commit_date" git commit -m "$msg" --date "$commit_date"
    sleep 1  # Add a small delay to simulate real work
done

echo "20 commits successfully created for the MVC project template with past dates."
