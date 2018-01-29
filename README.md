# Paragraphs Frontend ui

Paragraphs Frontend ui is intended as a POC for editing paragraphs from the frontend.

It is based on ideas from geysir and landingspage, but is based on paragraphs_edit.
That way it has better support for QuickEdit

The following features are currently available in the frontend trough contextual links:

* Quick Edit
* Editing of the content inside a modal
* Edit a different form mode 'Settings' from te settings tray
* Move paragraph items up/down
* Duplicate paragraph items
* Add a predefined paragraph sets from the settings tray

## Screen recorings

Some gifs demonstrating the magic

### Editing paragraphs settings & quick edit
https://www.dropbox.com/s/qg640za04222lg4/settings%26quickedit.gif?raw=1

### Duplicating & moving paragraphs
https://www.dropbox.com/s/wdqvxdki22jgph4/move%26duplicate.gif?raw=1

### Using webforms with paragraphs
https://www.dropbox.com/s/oo2prxw57835dka/webform.gif?raw=1


## Install

After enabling the modules, you can create 'Paragraph sets' that can be added from the ui:

admin/structure/paragraph_set

It is also recomended to update the 'settings' form mode on your existing paragraph types.


## Known problems

For now it only works for non-multilingual websites.

For now only admins can edit the frontend like this.

The goal is to use this POC to start on conversation about frontend editing capabilities  for Paragraphs.
