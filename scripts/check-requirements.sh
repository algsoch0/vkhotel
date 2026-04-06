#!/bin/bash

# VK Hotel - System Requirements Check Script

echo "🔍 Checking VK Hotel System Requirements..."
echo ""

# Check PHP version
echo "✓ Checking PHP..."
php -v | head -1
php_minimal="8.1"
php_version=$(php -r 'echo PHP_VERSION;' | cut -d. -f1,2)

if (( $(echo "$php_version >= $php_minimal" | bc -l) )); then
    echo "  ✅ PHP version OK (≥ 8.1)"
else
    echo "  ❌ PHP version too old (requires ≥ 8.1)"
fi

echo ""

# Check Composer
echo "✓ Checking Composer..."
if command -v composer &> /dev/null; then
    composer --version
    echo "  ✅ Composer installed"
else
    echo "  ❌ Composer not found"
fi

echo ""

# Check Node.js
echo "✓ Checking Node.js..."
if command -v node &> /dev/null; then
    node -v
    echo "  ✅ Node.js installed"
else
    echo "  ❌ Node.js not found"
fi

echo ""

# Check npm
echo "✓ Checking npm..."
if command -v npm &> /dev/null; then
    npm -v
    echo "  ✅ npm installed"
else
    echo "  ❌ npm not found"
fi

echo ""

# Check required PHP extensions
echo "✓ Checking PHP Extensions..."
required_extensions=("pdo" "pdo_mysql" "pdo_pgsql" "mbstring" "curl" "json" "xml")

for ext in "${required_extensions[@]}"; do
    if php -m | grep -q "^$ext$"; then
        echo "  ✅ $ext"
    else
        echo "  ⚠️  $ext (not loaded)"
    fi
done

echo ""
echo "🎉 System check complete!"
