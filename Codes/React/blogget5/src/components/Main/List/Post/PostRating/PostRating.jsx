import React from 'react'
import style from '../Post.module.css'
import PropTypes from 'prop-types'
import { Text } from '../../../../../UI/Text'

export const PostRating = ({ ups }) => (
	<div className={style.rating}>
		<button className={style.up} aria-label='Увеличить рейтинг' />
		<Text As='p' bold size={12} tsize={12} dsize={16} color='grey99'>
			{ups}
		</Text>
		<button className={style.down} aria-label='Уменьшить рейтинг' />
	</div>
)

PostRating.propTypes = {
	ups: PropTypes.number,
}
