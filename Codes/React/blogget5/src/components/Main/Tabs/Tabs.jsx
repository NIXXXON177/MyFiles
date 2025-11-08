import React, { useEffect, useState } from 'react'
import style from './Tabs.module.css'
import PropTypes from 'prop-types'
import { assignId } from '../../../utils/generateRandomId'
import { debounceRaf } from '../../../utils/debounce'
import { Text } from '../../../UI/Text'

import { ReactComponent as ArrowIcon } from './img/arrow.svg'
import { ReactComponent as TopIcon } from './img/top.svg'
import { ReactComponent as HomeIcon } from './img/home.svg'
import { ReactComponent as BestIcon } from './img/best.svg'
import { ReactComponent as HotIcon } from './img/hot.svg'

const LIST = [
	{ value: 'Главная', Icon: HomeIcon },
	{ value: 'Топ', Icon: TopIcon },
	{ value: 'Лучшие', Icon: BestIcon },
	{ value: 'Горячие', Icon: HotIcon },
].map(assignId)

export const Tabs = ({ list, setList }) => {
	const [isDropdownOpen, setIsDropdownOpen] = useState(false)
	const [isDropDown, setIsDropDown] = useState(false)
	const [menuTitle, setMenuTitle] = useState('Главная')

	const handleResize = () => {
		if (document.documentElement.clientWidth < 768) {
			setIsDropDown(true)
		} else {
			setIsDropDown(false)
		}
	}

	useEffect(() => {
		const debounceResize = debounceRaf(handleResize)
		debounceResize()
		window.addEventListener('resize', debounceResize)
		return () => {
			window.removeEventListener('resize', debounceResize)
		}
	}, [])

	return (
		<div className={style.container}>
			{isDropDown && (
				<div className={style.wrapperBtn}>
					<button
						className={style.btn}
						onClick={() => setIsDropdownOpen(!isDropdownOpen)}
					>
						<Text bold>{menuTitle}</Text>
						<ArrowIcon width={15} height={15} />
					</button>
				</div>
			)}
			{(isDropdownOpen || !isDropDown) && (
				<ul
					className={style.list}
					onClick={() => {
						setIsDropdownOpen(false)
					}}
				>
					{LIST.map(({ value, id, Icon }) => (
						<li className={style.item} key={id}>
							<Text
								As='button'
								bold
								className={style.btn}
								onClick={() => {
									if (!isDropDown) return
									setMenuTitle(value)
								}}
							>
								{value}
								{Icon && <Icon width={30} height={30} />}
							</Text>
						</li>
					))}
				</ul>
			)}
		</div>
	)
}

Tabs.propTypes = {
	list: PropTypes.array,
	setList: PropTypes.func,
}
