# Settings Documentation

## Environment Configuration
- **Description**: Configuration settings that control the behavior of the ERP system.
- **Key Settings**:
  - `APP_ENV`: Application environment (e.g., local, production).
  - `APP_DEBUG`: Debug mode (true/false).
  - `APP_URL`: Base URL of the application.
  - `DB_CONNECTION`: Database connection type (e.g., mysql, pgsql).
  - `DB_HOST`: Database host address.
  - `DB_PORT`: Database port number.
  - `DB_DATABASE`: Name of the database.
  - `DB_USERNAME`: Database username.
  - `DB_PASSWORD`: Database password.

## Security Settings
- **Description**: Security-related configurations to ensure safe operation.
- **Key Settings**:
  - `HTTPS_ONLY`: Enforce HTTPS connections.
  - `FILE_UPLOAD_LIMIT`: Maximum file size for uploads.
  - `IMPORT_SECURITY_CHECKS`: Enable security checks for data imports.

## Localization Settings
- **Description**: Settings for multi-language support.
- **Key Settings**:
  - `DEFAULT_LOCALE`: Default language locale.
  - `FALLBACK_LOCALE`: Fallback language locale.