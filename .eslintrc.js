module.exports = {
    env: {
        browser: true,
        es2021: true,
    },
    extends: [
        'eslint:recommended',
    ],
    parserOptions: {
        ecmaVersion: 'latest',
        sourceType: 'module',
    },
    rules: {
        // Disable rules that conflict with Blade template syntax
        'no-unexpected-multiline': 'off',
        'no-unused-vars': ['error', { 'varsIgnorePattern': '^_' }],
        'no-undef': 'off',
        
        // Custom rules for Blade templates
        'no-template-curly-in-string': 'off',
    },
    overrides: [
        {
            files: ['**/*.blade.php'],
            rules: {
                // Disable all rules for Blade template files
                'no-undef': 'off',
                'no-unused-vars': 'off',
                'no-template-curly-in-string': 'off',
            },
        },
    ],
};