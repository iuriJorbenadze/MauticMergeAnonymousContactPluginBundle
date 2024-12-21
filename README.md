# Mautic Merge Anonymous Contact Plugin

---

## Description

The **Mautic Merge Anonymous Contact Plugin** improves Mautic's contact management by automatically merging anonymous contacts with identified contacts during the same browser session. This ensures accurate tracking continuity and consolidates contact data for better insights.

---

## Features

- Automatically merges anonymous contacts into identified contacts.
- Reassigns page hits, tracking history, and custom fields to the identified contact.
- Retains IP addresses and other tracking information from the anonymous contact.
- Ensures accurate data consolidation and eliminates duplicate contact entries.

---

## Installation Instructions

### Step 1: Download the Plugin
1. Download the plugin repository as a ZIP file or clone it from the repository.

### Step 2: Place the Plugin in the Correct Directory
1. Extract the plugin files and move the folder to the `plugins/` directory of your Mautic installation.
2. Rename the folder to `MauticMergeAnonymousContactPluginBundle`.

### Step 3: Clear the Mautic Cache
Run the following command to clear the cache and ensure Mautic recognizes the new plugin:

```bash
sudo /usr/bin/php /path-to-mautic/bin/console cache:clear
```

### Step 4: Install the Plugin

1. Navigate to the **Plugins** page in the Mautic admin panel.
2. Click the "Install/Upgrade Plugins" button to register the new plugin.

Alternatively, you can install the plugin via command line:

```bash
sudo /usr/bin/php /path-to-mautic/bin/console mautic:plugins:install
```

---

## User Flow Scenario

### Anonymous Contact Tracking
- A visitor lands on your website, which is tracked by the Mautic tracking script.
- Mautic creates an anonymous contact (e.g., Contact ID `100`) and tracks all page hits and activity under this ID.

### Email Interaction
- An email is sent to the same individual (who is tracked anonymously but has an email address in Mautic's database).
- When this person clicks the link in the email (in the same browser session), Mautic identifies the individual as a known contact (e.g., Contact ID `200`) and assigns a new contact ID to the browser.

### Default Mautic Behavior
- With Mautic’s default behavior, the old anonymous contact (`ID 100`) retains the tracked data, while the new identified contact (`ID 200`) starts tracking separately, leaving data fragmented.

### Plugin Functionality
- With this plugin, as soon as the browser’s cookie updates to `ID 200`, the plugin merges the tracked data from the old contact (`ID 100`) into the new identified contact (`ID 200`).
- This ensures all tracking history, page hits, and custom fields are consolidated under the identified contact (`ID 200`), providing a complete view of the individual’s activity.

---

## Development Details

### Directory Structure

- **`Config/`**: Contains configuration files (`config.php` and `services.php`).
- **`EventListener/`**: Contains the event subscriber `InterceptPageHitsSubscriber.php` for tracking and merging contacts.
- **`Integration/`**: Contains logic for Mautic integration.
- **`Assets/`**: Contains static assets such as icons.

---

## Contributors

- **Iuri Jorbenadze** - [Email](mailto:jorbenadze2001@gmail.com)
- **Lenon Leite** - [Email](mailto:lenonleite@gmail.com)

---

## License

This project is licensed under the GPL-3.0 License.

---
