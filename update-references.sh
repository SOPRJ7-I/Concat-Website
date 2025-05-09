#!/bin/bash

# Vervang oude padverwijzingen
find . -type f -name "*.php" -exec sed -i 's/resources\/views\/create_evenement/resources\/views\/events\/create/g' {} +
find . -type f -name "*.php" -exec sed -i 's/resources\/views\/index_evenement/resources\/views\/events\/index/g' {} +
