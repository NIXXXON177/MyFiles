import classNames from 'classnames'
import style from './Text.module.css'
import PropTypes from 'prop-types'

export const Text = prop => {
	const {
		As = 'span',
		color = 'black',
		size,
		tsize,
		dsize,
		className,
		children,
		href,
		center,
		weight = 'normal',
		medium,
		bold,
	} = prop

	const classes = classNames(
		className,
		style[color],
		{ [style[`fs${size}`]]: size },
		{ [style[`fst${tsize}`]]: tsize },
		{ [style[`fst${dsize}`]]: dsize },
		{ [style.center]: center },
		{ [style[`weight_${weight}`]]: weight && !medium && !bold },
		{ [style.medium]: medium },
		{ [style.bold]: bold }
	)

	return (
		<As className={classes} href={href}>
			{children}
		</As>
	)
}

Text.propTypes = {
	As: PropTypes.string,
	color: PropTypes.string,
	size: PropTypes.number,
	tsize: PropTypes.number,
	dsize: PropTypes.number,
	className: PropTypes.string,
	children: PropTypes.oneOfType([
		PropTypes.string,
		PropTypes.object,
		PropTypes.array,
	]),
	href: PropTypes.string,
	center: PropTypes.bool,
	weight: PropTypes.string,
	medium: PropTypes.bool,
	bold: PropTypes.bool,
}
