---
to: <%= absPath %>/<%= component_name %>.jsx
---
import React from 'react'
<% if (hasStyles) { -%>
import style from './<%= component_name %>.module.css'
<% } -%>
import PropTypes from 'prop-types'

export const <%= component_name %> = (props) => {
	return (
		<div<% if (hasStyles) { %> className={style.container}<% } %>></div>
	)
}

<%= component_name %>.propTypes = {
}
