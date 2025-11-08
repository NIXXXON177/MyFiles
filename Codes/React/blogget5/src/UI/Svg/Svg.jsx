import React, { useState, useEffect, useRef } from 'react'
import PropTypes from 'prop-types'

export const Svg = ({ src, className, width, height, ...otherProps }) => {
	const [svgContent, setSvgContent] = useState('')
	const [loading, setLoading] = useState(true)
	const [error, setError] = useState(null)
	const containerRef = useRef(null)

	useEffect(() => {
		const loadSvg = async () => {
			try {
				setLoading(true)
				setError(null)

				const response = await fetch(src)
				if (!response.ok) {
					throw new Error(`Failed to load SVG: ${response.statusText}`)
				}

				const svgText = await response.text()
				setSvgContent(svgText)
			} catch (err) {
				setError(err.message)
				console.error('Error loading SVG:', err)
			} finally {
				setLoading(false)
			}
		}

		if (src) {
			loadSvg()
		}
	}, [src])

	useEffect(() => {
		if (svgContent && containerRef.current) {
			const parser = new DOMParser()
			const svgDoc = parser.parseFromString(svgContent, 'image/svg+xml')
			const svgElement = svgDoc.querySelector('svg')

			if (svgElement) {
				// Клонируем элемент для избежания мутаций
				const clonedSvg = svgElement.cloneNode(true)

				if (width !== undefined) {
					clonedSvg.setAttribute('width', width)
				}
				if (height !== undefined) {
					clonedSvg.setAttribute('height', height)
				}
				if (className) {
					clonedSvg.setAttribute('class', className)
				}

				// Применяем остальные props как атрибуты
				Object.keys(otherProps).forEach(key => {
					const value = otherProps[key]
					if (value !== undefined && value !== null) {
						clonedSvg.setAttribute(key, value)
					}
				})

				containerRef.current.innerHTML = ''
				containerRef.current.appendChild(clonedSvg)
			}
		}
		// eslint-disable-next-line react-hooks/exhaustive-deps
	}, [svgContent, width, height, className])

	if (loading) {
		return null
	}

	if (error) {
		console.error('SVG loading error:', error)
		return null
	}

	return (
		<div
			ref={containerRef}
			style={{ display: 'inline-block', lineHeight: 0 }}
		/>
	)
}

Svg.propTypes = {
	src: PropTypes.string.isRequired,
	className: PropTypes.string,
	width: PropTypes.oneOfType([PropTypes.number, PropTypes.string]),
	height: PropTypes.oneOfType([PropTypes.number, PropTypes.string]),
}
