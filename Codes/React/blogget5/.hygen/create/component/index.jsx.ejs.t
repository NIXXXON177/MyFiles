---
to: <%= absPath %>/index.js
---
<% if (base_dir === 'UI') { -%>
export * from './<%= component_name %>'
<% } else { -%>
import {<%= component_name %>} from './<%= component_name %>'

export default <%= component_name %>
<% } -%>
