import React from 'react'
import style from '../Post.module.css'
import formatDate from '../../../../../utils/formatDate.js'
import PropTypes from 'prop-types'
import { Text } from '../../../../../UI/Text'

export const PostDate = ({ date }) => (
	<Text
		As='time'
		className={style.date}
		dateTime={date}
		bold
		size={12}
		tsize={16}
		color='grey99'
	>
		{formatDate(date)}
	</Text>
)

PostDate.propTypes = {
	date: PropTypes.string,
}
